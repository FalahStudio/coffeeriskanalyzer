$(document).ready(function () {
    $("[data-dropdown]").on("click", function (e) {
        e.stopPropagation();

        var dropdownId = $(this).data("dropdown");
        $("#" + dropdownId).toggleClass("hidden");
    });

    $(document).on("click", function (e) {
        if (!$(e.target).closest("[data-dropdown]").length) {
            $("[data-dropdown]").each(function () {
                var dropdownId = $(this).data("dropdown");
                $("#" + dropdownId).addClass("hidden");
            });
        }
    });
});
