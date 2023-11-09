$("body").on("click", ".add-checkbox", function () {
    var id = $(this).attr('data-id');
    var queryString = '';
    var action = '';
    if ($(this).is(':checked')) {
        console.log(id);
        queryString = 'action=add&id=' + id;
        action = 'add';
    } else {
        console.log('remove cart');
        queryString = 'action=remove&id=' + id;
        action = 'remove';
    }

    // console.log(URLROOT);

    cartProcess(id, queryString, action);

    checkCart();
});

$('#add-to-cart').click(function () {
    var id = $(this).attr('data-id');
    var queryString = '';
    var action = 'add';

    queryString = 'action=add&id=' + id;
    cartProcess(id, queryString, action);
    checkCart();
    $(this).prop('disabled', true);
});

function cartProcess(id, queryString, action) {
    $.ajax({
        url: "/shop/cart/process",
        data: queryString,
        type: "POST",
        dataType: 'json',
        async: false,
        success: function (data) {
            if (data.status == 'success') {
                if (action == 'add') {
                    var rug = data.rug;
                    var newitem = '<div class="rug-item" data-id="' + rug.id + '">'
                        + '<div class="rug-item-image"><a href="/rugs/' + rug.id + '">'
                        + '<img src="' + URLROOT + 'uploads/' + rug.image + '" alt="' + rug.asset_number + '" class="w-100"></a></div>'
                        + '<div class="rug-item-desc">' + rug.asset_number + '<br>' + rug.size_width_ft + '\' ' + rug.size_width_in + '" x ' + rug.size_length_ft + '\' ' + rug.size_length_in + '"<br>' + rug.location + '<br>'
                        + '<a href="#" class="cart-item-remove" data-id="' + rug.id + '"><span class="icon-highlight_remove"></span> Remove</a>'
                        + '</div></div>';
                    $('.cart-items').append(newitem);
                }
                if (action == 'remove') {
                    if (data.status == 'success') {
                        $('.cart-items').find('.rug-item[data-id="' + id + '"]').remove();
                        $('.add-checkbox[data-id="' + id + '"]').prop('checked', false);
                        $('#add-to-cart[data-id="' + id + '"]').removeAttr('disabled');
                    }
                }
            }

            var cartCount = $('.cart-count').text();
            if (action == 'add') {
                cartCount = parseInt(cartCount) + 1;
            } else {
                cartCount = parseInt(cartCount) - 1;
            }
            console.log(cartCount);
            $('.cart-count').text(cartCount);
        }
    });
}


$("body").on("click", ".cart-item-remove", function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');

    var queryString = 'action=remove&id=' + id;
    var action = 'remove';

    cartProcess(id, queryString, action);

    // $.ajax({
    //     url: "/shop/cart/process",
    //     data: queryString,
    //     type: "POST",
    //     dataType: 'json',
    //     async: false,
    //     success: function (data) {
    //         if (data.status == 'success') {
    //             $('.cart-items').find('.rug-item[data-id="' + id + '"]').remove();
    //             $('.add-checkbox[data-id="' + id + '"]').prop('checked', false);
    //             $('#add-to-cart[data-id="' + id + '"]').removeAttr('disabled');
    //         }
    //     }
    // });

    checkCart();
});

function checkCart() {
    var cartItems = $('.cart-items').children('.rug-item');
    if (cartItems.length > 0) {
        $('.cart-checkout-btn').show();
        $('.cart-empty').hide();
    } else {
        $('.cart-checkout-btn').hide();
        $('.cart-empty').show();
    }
}

$('#cart-overlay').click(function () {
    $('#cart-wrap').removeClass('show');
});

$('.btn-cart-toggle').click(function (e) {
    $('#cart-wrap').toggleClass('show');

    e.preventDefault();
});