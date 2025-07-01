<?php
function append_version($url)
{
    $minute_version = floor(time() / 60);
    $glue = strpos($url, '?') === false ? '?' : '&';
    return $url . $glue . 'v=' . $minute_version;
}

$resources = [
    'css' => array_map('append_version', [
        get_template_directory_uri() . '/assets/js/zarcore/zarcore.min.css',
        get_template_directory_uri() . '/assets/css/style.css',
        'https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css',
    ]),
    'js' => array_map('append_version', [
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        'https://www.googletagmanager.com/gtag/js?id=G-957DHXFTLJ',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/ScrollTrigger.min.js',
        'https://www.google.com/recaptcha/api.js?render=6LfO81UiAAAAAGpbIhZxY5L-BdoWLIcZwLDmCHeY'
    ])
];
?>

<script defer src="<?php echo get_template_directory_uri() ?>/assets/js/zarcore/zarcore.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" defer></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const lazyLoader = new zarcore.LazyLoader();
        lazyLoader.init();

        const resources = <?php echo json_encode($resources); ?>;

        function handleUserInteraction() {
            zarcore.loadResources(
                resources.css,
                resources.js,
                () => {

                    // Tampilkan halaman terlebih dahulu
                    document.querySelectorAll('.lcph').forEach(el => el.style.display = 'block');
                    document.getElementById('root').style.display = 'block';
                    document.getElementsByClassName('loading-overlay')[0].style.display = 'none';

                    // Handle Google tag manager
                    window.dataLayer = window.dataLayer || [];

                    function gtag() {
                        dataLayer.push(arguments);
                    }
                    gtag('js', new Date());
                    gtag('config', 'G-957DHXFTLJ');

                    <?php RenderJS::PrintJS(); ?>

                    // Alert Construction Mode
                    const duration = 24;
                    const now = Date.now();
                    if (((now - localStorage.getItem('alertConstruction')) / (1000 * 60 * 60)) >= duration) {
                        ZarrAlert.show({
                            status: "Our Website is Under Construction!",
                            message: "Sorry, we’re currently making improvements to enhance your experience."
                        });
                        localStorage.setItem('alertConstruction', now);
                    }
                }
            );
        }

        function loadResourcesWithIdleCallback() {
            zarcore.loadResources(resources.css, [], handleUserInteraction);
        }

        if ('requestIdleCallback' in window) {
            window.requestIdleCallback(() => {
                if (localStorage.getItem('hijrLoadpage') === 'true') {
                    loadResourcesWithIdleCallback();
                } else {
                    if (document.readyState === 'complete') {
                        setTimeout(() => {
                            loadResourcesWithIdleCallback();
                        }, 1000);
                    } else {
                        ['focus', 'scroll', 'mousemove'].forEach(event => {
                            window.addEventListener(event, () => {
                                // localStorage.setItem('hijrLoadpage', 'true');
                                loadResourcesWithIdleCallback();
                            }, {
                                once: true
                            });
                        });
                    }
                }
            });
        } else {
            window.addEventListener('load', handleUserInteraction);
        }

        function isCrawlerOrPerformanceTool() {
            const crawlerAgents = [
                'Googlebot', 'Bingbot', 'Slurp', 'DuckDuckBot', 'Baiduspider',
                'YandexBot', 'Sogou', 'Exabot', 'facebot', 'ia_archiver',
                'PageSpeed', 'GTmetrix', 'Lighthouse'
            ];

            const userAgent = navigator.userAgent;
            const isCrawler = crawlerAgents.some(agent => userAgent.includes(agent));
            if (isCrawler) return true;

            const resources = performance.getEntriesByType("resource");
            return resources.length > 100 && !window.navigator.userActivation.hasBeenActive;
        }
    });

    function clearExpiredCache(expireMillis = 60000) {
        const dbRequest = indexedDB.open("resourceCache", 1);

        dbRequest.onsuccess = () => {
            const db = dbRequest.result;
            const tx = db.transaction("resources", "readwrite");
            const store = tx.objectStore("resources");
            const now = Date.now();

            const cursorRequest = store.openCursor();

            cursorRequest.onsuccess = (event) => {
                const cursor = event.target.result;
                if (cursor) {
                    const entry = cursor.value;
                    // entry.cachedAt must exist if zarcore saved it with timestamp  
                    if (entry.cachedAt && (now - entry.cachedAt) > expireMillis) {
                        store.delete(cursor.primaryKey);
                        console.log(`Deleted cached resource: ${entry.url}`);
                    }
                    cursor.continue();
                }
            };

            cursorRequest.onerror = (event) => {
                console.error("Cursor error during cache clear:", event.target.error);
            };

            tx.oncomplete = () => {
                db.close();
            };
        };

        dbRequest.onerror = (event) => {
            console.error("IndexedDB open error:", event.target.error);
        };
    }

    // Run cache clear every 1 minute  
    setInterval(() => clearExpiredCache(60000), 60000);
</script>