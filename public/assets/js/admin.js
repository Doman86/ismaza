/* ============================================================
   For Ismaza — admin scripts
   ============================================================ */

(function () {
    'use strict';

    function ready(fn) {
        if (document.readyState !== 'loading') {
            fn();
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    }

    ready(function () {
        initNavbar();
        initFlash();
    });

    /* ---------- Topbar mobile toggle ---------- */
    function initNavbar() {
        var toggle = document.getElementById('navToggle');
        var links = document.getElementById('navLinks');
        if (!toggle || !links) return;

        toggle.addEventListener('click', function () {
            var isOpen = links.classList.toggle('open');
            toggle.classList.toggle('open', isOpen);
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    }

    /* ---------- Flash auto-hide ---------- */
    function initFlash() {
        var flashes = document.querySelectorAll('.flash');
        if (!flashes.length) return;

        flashes.forEach(function (flash) {
            var closeBtn = flash.querySelector('.flash-close');
            var hide = function () {
                flash.classList.add('hide');
                setTimeout(function () { flash.remove(); }, 350);
            };

            if (closeBtn) closeBtn.addEventListener('click', hide);
            setTimeout(hide, 6000);
        });
    }
})();
