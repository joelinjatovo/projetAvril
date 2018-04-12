$(window).on("scroll touchmove", function () {
    $('#head').toggleClass('shrink', $(document).scrollTop() > 0);
});
