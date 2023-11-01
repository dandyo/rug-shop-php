$(function () {
    $("#checkoutForm").find('textarea,input,select').jqBootstrapValidation({
        preventSubmit: !0,
        submitError: function (t, e, s) { },
        submitSuccess: function (t, e) {
            e.preventDefault(), e.stopPropagation();
            $.ajax({
                url: "/shop/cart/send",
                // url: "/mail/cart-send.php",
                type: "POST",
                data: t.serialize(),
                cache: !1,
                success: function (data) {
                    $("#success").html("<div class='alert alert-success alert-dismissible fade show'><span>Your message has been sent! </span><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
                    // console.log(data);

                    $("#checkoutForm").trigger("reset");

                    window.location.href = "/shop/cart/thankyou";
                },
                error: function (data) {
                    $("#success").html("<div class='alert alert-danger alert-dismissible fade show'>Sorry, it seems that my mail server is not responding. Please try again later!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
                    console.log(data);

                    // $("#checkoutForm").trigger("reset");
                },
            });
        },
        filter: function () {
            return $(this).is(":visible");
        },
    });
});
