define(['jquery'], function($) {
    return {
        init: function() {
            var script = document.createElement('script');
            script.src = M.cfg.wwwroot + '/theme/prime/javascript/wow.min.js';
            script.onload = function() {
                if (typeof WOW !== 'undefined') {
                    var wow = new WOW({
                        offset: 100,
                        mobile: true,
                        live: true
                    });
                    wow.init();

                    // Forzar revisión después de cargar
                    setTimeout(function() {
                        wow.sync();
                    }, 500);
                }
            };
            document.head.appendChild(script);
        }
    };
});