$(document).ready(function () {
    $("#close_toast").on("click", function () {
        $("#toaster").fadeOut(300, function () {
            $(this).remove();
        });
    });

    setTimeout(function () {
        $("#toaster").fadeOut(300, function () {
            $(this).remove();
        });
    }, 3000);
});
