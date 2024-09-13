$(document).ready(function () {
    $("[id^=tabs-header-]").not("#tabs-header-1").hide();

    function updateHeaderSteps(tabId) {
        $("[id^=header_step_]").removeClass("active");

        $("#header_step_" + tabId.split("-")[2]).addClass("active");

        $("[id^=header_step_]").each(function () {
            var isActive = $(this).hasClass("active");
            var headerBox = $(this).find("[id^=header_box_]");
            var headerBoxData = $(this).find("[id^=header_box_data_]");
            var headerText = $(this).find("[id^=header_text_]");

            if (isActive) {
                headerBox
                    .removeClass("text-neutral-950")
                    .addClass("text-neutral-50");
                headerBoxData
                    .removeClass("bg-white")
                    .addClass("bg-primary-700");
                headerText
                    .removeClass("text-neutral-600")
                    .addClass("text-primary-700");
            } else {
                headerBox
                    .removeClass("text-neutral-50")
                    .addClass("text-neutral-950");
                headerBoxData
                    .removeClass("bg-primary-700")
                    .addClass("bg-white");
                headerText
                    .removeClass("text-primary-700")
                    .addClass("text-neutral-600");
            }
        });
    }

    $('[data-button-tab="next-tab"]').click(function () {
        var currentTab = $(this).closest("[id^=tabs-header-]");
        var nextTab = currentTab.next("[id^=tabs-header-]");

        currentTab.hide();
        nextTab.show();

        updateHeaderSteps(nextTab.attr("id"));
    });

    $('[data-button-tab="prev-tab"]').click(function () {
        var currentTab = $(this).closest("[id^=tabs-header-]");
        var prevTab = currentTab.prev("[id^=tabs-header-]");

        currentTab.hide();
        prevTab.show();

        updateHeaderSteps(prevTab.attr("id"));
    });
});
