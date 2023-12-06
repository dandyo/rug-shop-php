$('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
$('.quantity').each(function () {
    var spinner = $(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

    btnUp.click(function () {
        var oldValue = parseFloat(input.val());
        console.log(oldValue);
        if (oldValue >= max) {
            var newVal = oldValue;
        } else if (isNaN(oldValue)) {
            var newVal = 1;
        } else {
            var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

    btnDown.click(function () {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
            var newVal = oldValue;
        } else if (isNaN(oldValue)) {
            var newVal = 0;
        } else {
            var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

});

var arrayClean = function (thisArray, thisName) {
    "use strict";
    $.each(thisArray, function (index, item) {
        if (item.name == thisName) {
            delete thisArray[index];
        }
    });
}

// $('#search-filters').on('submit', function (e) {
//     e.preventDefault();
//     console.log('asd');

//     $('#search-filters').submit();
// });

$('.search-params .badge').click(function () {
    var sizeArr = ['size_width_ft_min', 'size_width_in_min', 'size_width_ft_max', 'size_width_in_max', 'size_length_ft_min', 'size_length_in_min', 'size_length_ft_max', 'size_length_in_max'];

    var type = $(this).attr('data-param');

    var forminputs = $('#search-filters').serializeArray();
    // console.log(forminputs);
    // console.log(forminputs);
    var includesArr = [];

    if (type == "size") {
        for (var key in forminputs) {
            var name = forminputs[key].name;
            if (name.indexOf('size') > -1) {
                includesArr.push(key);
            } else {
                console.log(forminputs[key].name + ' not includes');
            }
        }

        for (var i = includesArr.length - 1; i >= 0; i--)
            forminputs.splice(includesArr[i], 1);

    } else {
        for (var key in forminputs) {
            if (forminputs[key].name == type) {
                forminputs.splice(key, 1);
            }
        }
    }

    var url = $.param(forminputs);
    window.location.replace('?' + url);
});