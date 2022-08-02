var CACHE_NAME = 'app-v1';
//alterar o nome do cache_name caso eu queira que o service worker atualize a lista de arquivos que tem que ser salva no dispositivo 
//visto isso, ele irá considerar sempre a ultima versão, não é possível transitar entre as versões

self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open(CACHE_NAME).then(function (cache) {
            return cache.addAll([
                'index.html',
                'js/admin.js',
                'js/ajax.js',
                'js/deslog.js',
                'js/empresa.js',
                'js/logo.js',
                'js/materialize.min.js'

            ]);
        })
    )
});

self.addEventListener('activate', function activator(event) {
    event.waitUntil(
        caches.keys().then(function (keys) {
            return Promise.all(keys
                .filter(function (key) {
                    return key.indexOf(CACHE_NAME) !== 0;
                })
                .map(function (key) {
                    return caches.delete(key);
                })
            );
        })
    );
});

self.addEventListener('fetch', function (event) {
    event.respondWith(
        caches.match(event.request).then(function (cachedResponse) {
            return cachedResponse || fetch(event.request);
        })
    );
});
