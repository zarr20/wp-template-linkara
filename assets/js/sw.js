const CACHE_NAME = 'hijr-cache-v1';
const urlsToCache = [
    `${self.location.origin}/`,
    'https://code.jquery.com/jquery-3.7.1.slim.min.js',
    'https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js',
    'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js',
    'https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css',
    // `${self.location.origin}/assets/js/zarr-js/index.js`,
];

// Install event - cache the defined URLs
self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(CACHE_NAME).then(function(cache) {
            return Promise.all(
                urlsToCache.map(function(url) {
                    return fetch(url, { mode: 'no-cors' }).then(function(response) {
                        if (response.ok || response.type === 'opaque') {
                            return cache.put(url, response);
                        }
                        return Promise.reject('Failed to fetch ' + url);
                    });
                })
            );
        })
    );
});

// Fetch event - respond with cached resources or fetch from network
self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request).then(function(response) {
            if (response) {
                return response;
            }
            return fetch(event.request, { mode: 'no-cors' }).then(function(networkResponse) {
                if (networkResponse.type === 'opaque' || networkResponse.ok) {
                    return caches.open(CACHE_NAME).then(function(cache) {
                        cache.put(event.request, networkResponse.clone());
                        return networkResponse;
                    });
                }
                return networkResponse;
            });
        }).catch(function() {
            return fetch(event.request);
        })
    );
});

// Activate event - clean up old caches
self.addEventListener('activate', function(event) {
    var cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then(function(cacheNames) {
            return Promise.all(
                cacheNames.map(function(cacheName) {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});
