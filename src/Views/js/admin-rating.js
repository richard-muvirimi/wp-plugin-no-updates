(function ($) {
    "use strict";

    $(document).ready(function () {

        const pluginName = window["no_updates"].name;

        $("." + pluginName + " a.btn-yield, ." + pluginName + " a.btn-remind, ." + pluginName + " a.btn-cancel")
            .click(function (e) {
                e.preventDefault();

                const element = this;

                $.post({
                    url: window["no_updates"].ajax_url,
                    data: {
                        _ajax_nonce: $(element).data("nonce"),
                        action: pluginName + "-" + $(element).data("action"),
                    },
                    success: function (response) {
                        if (response.redirect) {
                            window.open(response.redirect, "_blank").focus();
                        }
                        $(element).closest(".notice").find(".notice-dismiss").click();
                    },
                });
            });
    });
})(jQuery);
