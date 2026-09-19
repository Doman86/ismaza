/* ============================================================
   For Ismaza — Luxury Interactions
   Preloader, floating hearts, reveal, counter, lightbox, dll.
   ============================================================ */

(function () {
    'use strict';

    document.documentElement.classList.add('js');

    function ready(fn) {
        if (document.readyState !== 'loading') fn();
        else document.addEventListener('DOMContentLoaded', fn);
    }

    ready(function () {
        initPreloader();
        initReveal();
        initSplitTitle();
        initHearts();
        initCounters();
        initNavbar();
        initFlash();
        initLightbox();
        initLoginTabs();
        initSmoothAnchors();
    });

    /* ========================================================
       PRELOADER — tirai pembuka, sekali per sesi
       ======================================================== */
    function initPreloader() {
        var pre = document.getElementById('preloader');
        if (!pre) return;

        // Tampilkan preloader penuh hanya sekali per sesi browser
        var seen = false;
        try {
            seen = sessionStorage.getItem('ismaza-opened') === '1';
        } catch (e) { /* storage diblokir */ }

        if (seen) {
            pre.classList.add('done');
            return;
        }

        try { sessionStorage.setItem('ismaza-opened', '1'); } catch (e) {}

        setTimeout(function () {
            pre.classList.add('done');
        }, 2200);
    }

    /* ========================================================
       REVEAL ON SCROLL
       ======================================================== */
    function initReveal() {
        var els = document.querySelectorAll('.reveal, .reveal-scale');
        if (!els.length) return;

        if (!('IntersectionObserver' in window)) {
            els.forEach(function (el) { el.classList.add('in-view'); });
            return;
        }

        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

        els.forEach(function (el) { io.observe(el); });
    }

    /* ========================================================
       HERO TITLE — animasi masuk per kata
       ======================================================== */
    function initSplitTitle() {
        document.querySelectorAll('[data-split]').forEach(function (el) {
            var words = el.textContent.trim().split(/\s+/);
            el.textContent = '';

            words.forEach(function (word, i) {
                var span = document.createElement('span');
                span.className = 'word';
                span.style.setProperty('--wd', (i * 110) + 'ms');
                span.textContent = word;
                el.appendChild(span);
                el.appendChild(document.createTextNode(' '));
            });
        });
    }

    /* ========================================================
       HATI BERTABURAN — canvas lembut & hemat
       ======================================================== */
    function initHearts() {
        var canvas = document.getElementById('hearts');
        if (!canvas || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

        var ctx = canvas.getContext('2d');
        if (!ctx) return;

        var DPR = Math.min(window.devicePixelRatio || 1, 2);
        var W, H, hearts = [];
        var COUNT = window.innerWidth < 720 ? 12 : 20;
        var COLORS = ['rgba(201,143,150,', 'rgba(239,212,137,', 'rgba(156,175,136,'];

        function resize() {
            W = canvas.width = window.innerWidth * DPR;
            H = canvas.height = window.innerHeight * DPR;
            canvas.style.width = window.innerWidth + 'px';
            canvas.style.height = window.innerHeight + 'px';
        }

        function makeHeart(initial) {
            var speed = 0.15 + Math.random() * 0.3;
            return {
                x: Math.random() * W,
                y: initial ? Math.random() * H : H + 20 * DPR,
                size: (4 + Math.random() * 7) * DPR,
                speed: speed * DPR,
                sway: Math.random() * Math.PI * 2,
                swaySpeed: 0.004 + Math.random() * 0.008,
                swayAmp: (10 + Math.random() * 22) * DPR,
                alpha: 0.10 + Math.random() * 0.18,
                color: COLORS[Math.floor(Math.random() * COLORS.length)]
            };
        }

        function drawHeart(h) {
            var s = h.size;
            ctx.beginPath();
            ctx.moveTo(h.x, h.y + s * 0.3);
            ctx.bezierCurveTo(h.x, h.y, h.x - s / 2, h.y - s * 0.4, h.x - s / 2, h.y + s * 0.1);
            ctx.bezierCurveTo(h.x - s / 2, h.y + s * 0.55, h.x, h.y + s * 0.75, h.x, h.y + s);
            ctx.bezierCurveTo(h.x, h.y + s * 0.75, h.x + s / 2, h.y + s * 0.55, h.x + s / 2, h.y + s * 0.1);
            ctx.bezierCurveTo(h.x + s / 2, h.y - s * 0.4, h.x, h.y, h.x, h.y + s * 0.3);
            ctx.closePath();
            ctx.fillStyle = h.color + h.alpha + ')';
            ctx.fill();
        }

        function tick() {
            ctx.clearRect(0, 0, W, H);

            hearts.forEach(function (h, i) {
                h.y -= h.speed;
                h.sway += h.swaySpeed;
                h.x += Math.sin(h.sway) * 0.4 * DPR;

                if (h.y < -30 * DPR) hearts[i] = makeHeart(false);
                drawHeart(h);
            });

            requestAnimationFrame(tick);
        }

        resize();
        window.addEventListener('resize', function () {
            resize();
            hearts = [];
            for (var i = 0; i < COUNT; i++) hearts.push(makeHeart(true));
        });

        for (var i = 0; i < COUNT; i++) hearts.push(makeHeart(true));
        requestAnimationFrame(tick);
    }

    /* ========================================================
       COUNTER — angka menghitung naik saat terlihat
       ======================================================== */
    function initCounters() {
        var counters = document.querySelectorAll('[data-count]');
        if (!counters.length) return;

        function animate(el) {
            var target = parseInt(el.getAttribute('data-count'), 10) || 0;
            var dur = 1600;
            var start = null;

            function step(ts) {
                if (!start) start = ts;
                var p = Math.min((ts - start) / dur, 1);
                var eased = 1 - Math.pow(1 - p, 3);
                el.textContent = Math.round(target * eased).toLocaleString('id-ID');
                if (p < 1) requestAnimationFrame(step);
            }

            requestAnimationFrame(step);
        }

        if (!('IntersectionObserver' in window)) {
            counters.forEach(function (el) {
                el.textContent = (parseInt(el.getAttribute('data-count'), 10) || 0).toLocaleString('id-ID');
            });
            return;
        }

        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animate(entry.target);
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.4 });

        counters.forEach(function (el) { io.observe(el); });
    }

    /* ========================================================
       NAVBAR MOBILE
       ======================================================== */
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

    /* ========================================================
       FLASH AUTO-HIDE
       ======================================================== */
    function initFlash() {
        document.querySelectorAll('.flash').forEach(function (flash) {
            var closeBtn = flash.querySelector('.flash-close');
            var hide = function () {
                flash.classList.add('hide');
                setTimeout(function () { flash.remove(); }, 400);
            };

            if (closeBtn) closeBtn.addEventListener('click', hide);
            setTimeout(hide, 6000);
        });
    }

    /* ========================================================
       LIGHTBOX + NAVIGASI PREV/NEXT + KEYBOARD
       ======================================================== */
    function initLightbox() {
        var lightbox = document.getElementById('lightbox');
        if (!lightbox) return;

        var img = document.getElementById('lightboxImage');
        var title = document.getElementById('lightboxTitle');
        var desc = document.getElementById('lightboxDescription');
        var counter = document.getElementById('lightboxCounter');
        var prevBtn = lightbox.querySelector('.lb-prev');
        var nextBtn = lightbox.querySelector('.lb-next');

        var items = Array.prototype.slice.call(document.querySelectorAll('[data-lightbox-trigger]'));
        var current = 0;

        function show(index) {
            if (!items.length) return;
            current = (index + items.length) % items.length;

            var btn = items[current];
            if (img) {
                img.src = btn.getAttribute('data-src') || '';
                img.alt = btn.getAttribute('data-title') || '';
            }
            if (title) title.textContent = btn.getAttribute('data-title') || '';
            if (desc) {
                var d = btn.getAttribute('data-description') || '';
                desc.textContent = d;
                desc.style.display = d ? '' : 'none';
            }
            if (counter) counter.textContent = (current + 1) + ' / ' + items.length;
        }

        function open(index) {
            show(index);
            lightbox.classList.add('open');
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function close() {
            lightbox.classList.remove('open');
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        items.forEach(function (btn, i) {
            btn.addEventListener('click', function () { open(i); });
        });

        lightbox.querySelectorAll('[data-lightbox-close]').forEach(function (el) {
            el.addEventListener('click', close);
        });

        if (prevBtn) prevBtn.addEventListener('click', function () { show(current - 1); });
        if (nextBtn) nextBtn.addEventListener('click', function () { show(current + 1); });

        document.addEventListener('keydown', function (e) {
            if (!lightbox.classList.contains('open')) return;
            if (e.key === 'Escape') close();
            if (e.key === 'ArrowLeft') show(current - 1);
            if (e.key === 'ArrowRight') show(current + 1);
        });

        // Sembunyikan tombol nav jika foto hanya satu
        if (items.length < 2 && prevBtn && nextBtn) {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'none';
        }
    }

    /* ========================================================
       TAB LOGIN (Ismaza / Admin)
       ======================================================== */
    function initLoginTabs() {
        var tabs = document.querySelectorAll('.login-tab');
        if (!tabs.length) return;

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (t) { t.classList.remove('active'); });
                tab.classList.add('active');

                var ismazaForm = document.getElementById('form-ismaza');
                var adminForm = document.getElementById('form-admin');
                var isIsmaza = tab.getAttribute('data-tab') === 'ismaza';

                if (ismazaForm) ismazaForm.hidden = !isIsmaza;
                if (adminForm) adminForm.hidden = isIsmaza;
            });
        });
    }

    /* ========================================================
       ANCHOR LEMBUT
       ======================================================== */
    function initSmoothAnchors() {
        document.querySelectorAll('a[href^="#"]').forEach(function (link) {
            link.addEventListener('click', function (e) {
                var id = link.getAttribute('href');
                if (id.length < 2) return;

                var target = document.querySelector(id);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    }
})();
