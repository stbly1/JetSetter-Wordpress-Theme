/**
 * Twenty Fourteen keyboard support for image navigation.
 */(function(e){e(document).on("keydown.twentyfourteen",function(t){var n=!1;t.which===37?n=e(".previous-image a").attr("href"):t.which===39&&(n=e(".entry-attachment a").attr("href"));n&&!e("textarea, input").is(":focus")&&(window.location=n)})})(jQuery);