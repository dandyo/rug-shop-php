$('.formVariable').on('submit', function (e) {
    e.preventDefault();

    // var values = {};
    // $.each($(this).serializeArray(), function (i, field) {
    //     values[field.name] = field.value;
    // });

    $.ajax({
        url: "/shop/admin/settings/varadd",
        data: $(this).serialize(),
        type: "POST",
        dataType: 'json',
        async: false,
        success: function (data) {
            // console.log(data);

            if (data.status == 'success') {
                $('.alert--' + data.type).text();

                var value = (data.type == 'color') ? data.name : data.value;
                var i = (data.type == 'color') ? '<i style="background:' + data.value + ';"></i>' : '';

                var item = '<span data-id="var-' + data.id + '" data-src="/shop/admin/settings/varupdate/' + data.id + '" class="var-item" data-type="ajax" data-filter="#main" data-fancybox=>' + i + '' + value + '</span>';
                $('.var-list--' + data.type).append(item);
                $('.formVariable[data-type="' + data.type + '"]').trigger('reset');
            }
        },
        error: function (data) {
            if (data.responseJSON.status == "exists") {
                $('.alert--' + data.responseJSON.type).text('Item already exists');
            }
        }
    });
});