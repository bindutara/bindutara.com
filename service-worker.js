const CACHE_NAME = "bindutara-cache-v1";
const urlsToCache = [
  "/",
  "/index.html",
  "/css/style.css",
  "/js/main.js", // if applicable
  "/icons/icon-192.png",
  "/icons/icon-512.png"
];

// Install SW and cache essential files
self.addEventListener("install", event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});

// Serve cached files if available
self.addEventListener("fetch", event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request))
  );
});

// Clean up old caches
self.addEventListener("activate", event => {
  event.waitUntil(
    caches.keys().then(keyList =>
      Promise.all(keyList.map(key => {
        if (key !== CACHE_NAME) return caches.delete(key);
      }))
    )
  );
});
          
