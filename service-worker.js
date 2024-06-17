// Define the name of your cache
const cacheName = 'my-pwa-cache-v1';

// List of assets to cache
const assetsToCache = [
    '/',
    '/index.php',
    '/styles.css',
    '/js/main.js',
    '/images/icon-192x192.png',
    '/images/icon-512x512.png',
    // Add more URLs to cache as needed
];

// Install event: Cache assets
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(cacheName).then((cache) => {
            return cache.addAll(assetsToCache);
        })
    );
});

// Activate event: Remove old caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((name) => {
                    if (name !== cacheName) {
                        return caches.delete(name);
                    }
                })
            );
        })
    );
});

// Fetch event: Serve cached assets or fetch from network
self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request).then((cachedResponse) => {
            return cachedResponse || fetch(event.request);
        })
    );
});
