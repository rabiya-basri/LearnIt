$(document).ready(function(){
    $(".navShowHide").on("click", function () {

        var main = $("#mainSectionContainer");
        var nav = $("#sideNavContainer");

        if (main.hasClass("leftpadding")) {
            nav.hide();
        }
        else {
            nav.show();
        }
        main.toggleClass("leftpadding");

    });
});
function notSignedIn() {
    alert("You Must Signed In To Start Learning");
}