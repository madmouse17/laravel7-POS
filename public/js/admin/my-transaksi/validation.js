$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
        "Set-Cookie": "HttpOnly;Secure;SameSite=Strict",
    },
});

var validator = $("#form-submit").validate({
    highlight: function(element) {
        $(element)
            .closest(".form-group")
            .removeClass("has-success")
            .addClass("has-error");
    },
    success: function(element) {
        $(element)
            .closest(".form-group")
            .removeClass("has-error")
            .addClass("has-success");
    },
});

$("#form-submit").on("submit", (e) => {
    e.preventDefault();

    if (validator.form()) {
        // Catch all form data
        var formData = new FormData();
        formData.append("summary", ko.toJSON(MY.VM));

        // Create request
        const request = $.ajax({
            type: "POST",
            url: submitUrl,
            data: formData,
            contentType: false,
            processData: false,
        });

        request
            .then((response) => {
                swal({
                    text: response.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary",
                    },
                }).then(function() {
                    if (response.redirect) {
                        window.location.replace(response.redirect);
                    }
                });
            })
            .fail((error) => {
                var errText =
                    error.status === 500 ?
                    error.statusText :
                    error.responseJSON.message;
                swal({
                    text: errText,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary",
                    },
                });
            });
    }
});