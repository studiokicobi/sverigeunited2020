(function ($, root, undefined) {
  $(function () {
    // ("use strict");

    // Wrap sub-menus with a div
    $(".sub-menu").wrap('<div class="sub-menu-wrapper full-bleed">');

    // Toggle search field
    // ------------------------
    // var elem = ".search-box";

    $(".search-icon").click(function () {
      // Add a class to prevent the body from scrolling under the overlay
      $("body").toggleClass("no-scroll");
      // Slide down the search box
      $(".search-box").slideToggle();
      // Fade in the overlay
      $(".main-content-fade").fadeToggle();
    });

    $(document).on("keydown", function (e) {
      if (e.keyCode === 27) {
        // ESC
        $(".search-box").slideToggle(200);
        $(".main-content-fade").fadeToggle(200);
      }
    });

    $(document).ready(function () {
      $(".no-fouc").removeClass("no-fouc");
    });
  });
})(jQuery, this);
