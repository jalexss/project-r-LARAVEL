console.log("im in HOME!");

console.log({
    recetasUrl,
});
$(function () {
    var page = 1;
    var loadingSpinnerContainer = $("#loading-spinner-container");
    var recetaContainer = $("#receta-container");

    load_more(page);

    $(window).on("scroll", function (e) {
        console.log({ e });
        if (
            $(window).scrollTop() + $(window).height() >=
            $(document).height()
        ) {
            console.log("im inside");
            page++;
            loadingSpinnerContainer.removeClass("d-none");
            load_more(page);
        }
    });

    function load_more(page) {
        $(document).load(
            recetasUrl + "?page=" + page,
            function (response, status, xhr) {
                if (status == "error") {
                    alert("No response from server");
                }
                recetaContainer.append(response);
                loadingSpinnerContainer.addClass("d-none");
            }
        );
    }
});
