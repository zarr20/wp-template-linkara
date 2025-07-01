<?php

$cssResources = [
    'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
    get_template_directory_uri() . '/assets/css/bootstrap.min.css',
    get_template_directory_uri() . '/assets/css/icofont.min.css',
    get_template_directory_uri() . '/assets/css/linearicons.css',
    get_template_directory_uri() . '/assets/css/slick.css',
    get_template_directory_uri() . '/assets/css/animate.min.css',
    get_template_directory_uri() . '/assets/css/magnific-popup.css',
    get_template_directory_uri() . '/assets/css/meanmenu.css',
    get_template_directory_uri() . '/assets/css/default.css',
    'https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css',
    get_template_directory_uri() . '/assets/css/responsive.css',
    get_template_directory_uri() . '/assets/css/style.css',
    get_template_directory_uri() . '/assets/css/tw/style.css',
    'https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css',
    'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'
];
?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" defer></script>

<script>

    document.addEventListener("DOMContentLoaded", (event) => {

        const lazyLoader = new zarcore.LazyLoader();
        lazyLoader.init();

        const cssResources = [...<?php echo json_encode($cssResources); ?>, ...[<?php echo json_encode(get_registered_scripts_and_styles()['scripts']); ?>]];

        const jsResources = [
            ...[
                'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', // Swiper
                'https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js',
                'https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js',
                '<?php echo get_template_directory_uri(); ?>/assets/js/jquery.waypoints.min.js', // Waypoints
                '<?php echo get_template_directory_uri(); ?>/assets/js/jquery.counterup.min.js', // CounterUp
                '<?php echo get_template_directory_uri(); ?>/assets/js/jquery.meanmenu.min.js', // MeanMenu
                '<?php echo get_template_directory_uri(); ?>/assets/js/jquery.magnific-popup.min.js', // Magnific
                '<?php echo get_template_directory_uri(); ?>/assets/js/popper.min.js', // Popper
                '<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.min.js', // Bootstrap
                '<?php echo get_template_directory_uri(); ?>/assets/js/slick.min.js', // Slick
                'https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.js', // Locomotive
                '<?php echo get_template_directory_uri(); ?>/assets/js/isotope.pkgd.min.js', // Isotope
                '<?php echo get_template_directory_uri(); ?>/assets/js/imagesloaded.pkgd.min.js', // ImagesLoaded
            ],
            ...<?php echo json_encode(get_registered_scripts_and_styles()['styles']); ?>
        ];

        function handleUserInteraction() {
            zarcore.loadResources(
                [],
                jsResources,
                function () {
                    zarcore.loadResources([], [
                        'https://www.googletagmanager.com/gtag/js?id=G-G3RMH7B4VB',
                        // '<?php echo get_template_directory_uri(); ?>/assets/js/main.js',
                    ], () => {
                        googleTagManagerHandler();
                    });

                    $(document).ready(function () {
                        $('.hamburger-icon').click(function () {
                            $('#mobile-menu ul').stop(true, true).fadeToggle(300);
                        });
                    });

                    const elements = document.getElementsByClassName('lcph');
                    for (let i = 0; i < elements.length; i++) {
                        elements[i].style.display = 'block';
                    }
                    document.getElementsByClassName('root')[0].style.display = 'block';
                    document.getElementsByClassName('loading-overlay')[0].style.display = 'none';
                    <?php RenderJS::PrintJS(); ?>

                }
            );


        }

        if ('requestIdleCallback' in window) {
            const idleCallbackId = window.requestIdleCallback(() => {
                const loadResourcesCallback = () => {
                    localStorage.setItem('hijrLoadpage', 'true');
                    zarcore.loadResources(cssResources, [], () => {
                        window.removeEventListener('focus', loadResourcesCallback, { once: true });
                        document.removeEventListener('scroll', loadResourcesCallback);
                        document.removeEventListener('mousemove', loadResourcesCallback);
                        handleUserInteraction()
                    });
                };
                if (localStorage.getItem('hijrLoadpage') == 'true') {
                    loadResourcesCallback()
                } else {
                    window.addEventListener('focus', loadResourcesCallback, { once: true });
                    document.addEventListener('scroll', loadResourcesCallback, { once: true });
                    document.addEventListener('mousemove', loadResourcesCallback, { once: true });
                }

            });
        } else {
            window.addEventListener('load', () => {
                localStorage.setItem('hijrLoadpage', 'true');
                document.addEventListener('mousemove', handleUserInteraction());
                if (window.DeviceOrientationEvent) {
                    window.addEventListener('deviceorientation', handleUserInteraction());
                }
            });
        }


        function googleTagManagerHandler() {
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', 'G-G3RMH7B4VB');

            (function (w, d, s, l, i) {
                w[l] = w[l] || []; w[l].push({
                    'gtm.start':
                        new Date().getTime(), event: 'gtm.js'
                }); var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-NKMPVWQJ');

            !function (f, b, e, v, n, t, s) {
                if (f.fbq) return; n = f.fbq = function () {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
                n.queue = []; t = b.createElement(e); t.async = !0;
                t.src = v; s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '1284710312557694');
            fbq('track', 'PageView');
        }

        function isCrawlerOrPerformanceTool() {
            const crawlerUserAgents = [
                'Googlebot', 'Bingbot', 'Slurp', 'DuckDuckBot', 'Baiduspider',
                'YandexBot', 'Sogou', 'Exabot', 'facebot', 'ia_archiver',
                'PageSpeed', 'GTmetrix', 'Lighthouse', 'moto g power (2022)',
            ];

            const userAgent = navigator.userAgent;

            const isCrawler = crawlerUserAgents.some(agent => userAgent.includes(agent));
            if (isCrawler) {
                return true;
            }

            const resources = performance.getEntriesByType("resource");
            if (resources.length > 100 && !window.navigator.userActivation.hasBeenActive) {
                return true;
            }

            let isPaintDetected = false;
            const perfObserver = new PerformanceObserver((list) => {
                const entries = list.getEntries();
                if (entries.some(entry => entry.entryType === "paint")) {
                    isPaintDetected = true;
                }
            });

            perfObserver.observe({ entryTypes: ["paint", "resource"] });

            if (isPaintDetected) {
                return true;
            }

            return false;
        }

    }, false)
</script>