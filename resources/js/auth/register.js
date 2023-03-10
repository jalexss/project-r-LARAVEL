import debounce from "lodash.debounce";

$(function () {
    var emailInput = $("#email");
    var emailContainer = $("#email-container");
    var invalidFeedbackUsername = $("#invalid-feedback-username");
    var usernameInput = $("#username");
    var usernameContainer = $("#username-container");
    var invalidFeedbackEmail = $("#invalid-feedback-email");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    emailInput.on(
        "keyup",
        debounce(function (e) {
            e.preventDefault();
            if (e.target.value.length === 0) {
                emailInput.removeClass("is-invalid");
                emailInput.removeClass("is-valid");
                invalidFeedbackEmail.removeClass("invalid-feedback-email");
                return;
            }

            $.ajax({
                type: "get",
                url: urlRouteEmail,
                data: $(this).serialize(),
                success: function ({ isValid }) {
                    if (!isValid) {
                        emailInput.removeClass("is-invalid");
                        invalidFeedbackEmail.removeClass(
                            "invalid-feedback-email"
                        );
                        return emailInput.addClass("is-valid");
                    }
                    emailInput.addClass("is-invalid");
                    invalidFeedbackEmail.removeClass("d-none");
                },
            });
        }, 500)
    );

    usernameInput.on(
        "keyup",
        debounce(function (e) {
            e.preventDefault();
            if (e.target.value.length === 0) {
                usernameInput.removeClass("is-invalid");
                usernameInput.removeClass("is-valid");
                invalidFeedbackUsername.addClass("d-none");
                return;
            }
            $.ajax({
                type: "get",
                url: urlRouteUsername,
                data: $(this).serialize(),
                success: function ({ isValid }) {
                    if (!isValid) {
                        invalidFeedbackUsername.addClass("d-none");
                        usernameInput.removeClass("is-invalid");
                        return usernameInput.addClass("is-valid");
                    }

                    usernameInput.addClass("is-invalid");
                    invalidFeedbackUsername.removeClass("d-none");
                },
            });
        }, 500)
    );
});
