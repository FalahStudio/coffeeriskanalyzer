$(document).ready(function () {
    function toggleDropdown(dropdownId) {
        $("#" + dropdownId).toggleClass("hidden");
    }

    $("[data-dropdown]").on("click", function (e) {
        e.stopPropagation();
        var dropdownId = $(this).data("dropdown");
        var dropdown = $("#" + dropdownId);

        toggleDropdown(dropdownId);

        if (!dropdown.hasClass("hidden")) {
            $("[data-dropdown]")
                .not(this)
                .each(function () {
                    var otherDropdownId = $(this).data("dropdown");
                    if ($("#" + otherDropdownId).is(":visible")) {
                        $("#" + otherDropdownId).addClass("hidden");
                    }
                });
        }
    });

    $(document).on("click", function (e) {
        if (!$(e.target).closest("[data-dropdown], .dropdown-content").length) {
            $("[data-dropdown]").each(function () {
                var dropdownId = $(this).data("dropdown");
                $("#" + dropdownId).addClass("hidden");
            });
        }
    });

    $("[data-dropdown]").each(function () {
        var dropdownId = $(this).data("dropdown");
        if ($(this).data("open")) {
            $("#" + dropdownId).removeClass("hidden");
        } else {
            $("#" + dropdownId).addClass("hidden");
        }
    });
});
