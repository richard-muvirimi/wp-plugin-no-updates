(function ($) {
  "use strict";

  $(document).ready(function () {
    $(
      "." +
        window.no_updates.name +
        " a.btn-rate, ." +
        window.no_updates.name +
        " a.btn-remind, ." +
        window.no_updates.name +
        " a.btn-cancel"
    ).click(function (e) {
      e.preventDefault();

      $.post({
        url: window.no_updates.ajax_url,
        data: {
          _ajax_nonce: $(this).data("nonce"),
          action: window.no_updates.name + "-" + $(this).data("action"),
        },
        async: false,
        success: function (response) {
          if (response.redirect) {
            window.open(response.redirect, "_blank").focus();
          }
          $("." + window.no_updates.name + " .notice-dismiss").click();
        },
      });
    });
  });
})(jQuery);
