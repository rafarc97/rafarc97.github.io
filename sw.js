/* Las progressive web apps nos permiten guardar en caché todos los recursos
estáticos que no vayan a cambiar en nuestra aplicación y los podremos
guardar ya directamente en el disco duro del usuario del dispositivo que 
esté visualizando la aplicación web.

Tenemos que asignar un nombre a la versión de nuestro caché. */

const CACHE_NAME = 'v1_cache_rafarc_blog',
  urlsToCache = [
    '/',
    'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
    'https://kit.fontawesome.com/ad96b4fe27.js',
    'https://fonts.googleapis.com/css?family=Poppins:600&display=swap',
    'https://cdnjs.cloudflare.com/ajax/libs/hamburgers/1.1.3/hamburgers.min.css',
    'https://kit.fontawesome.com/a81368914c.js',
    'img/*',
    'css/estilos2.css',
    'css/normalize.css',
    'index.js'
  ]


/* Durante la fase de instalación, generalmente se almacena en caché
los activos estáticos */
self.addEventListener('install', function(event) {
    // Perform install steps
    event.waitUntil(
      caches.open(CACHE_NAME)
        .then(function(cache) {
          console.log('Opened cache');
          return cache.addAll(urlsToCache);
        })
    );
  });

/* Una vez que se instala el SW, se activa y busca los recursos para
hacer que funcione sin conexión */
self.addEventListener('activate', e => {
    const cacheWhitelist = [CACHE_NAME];
    e.waitUntil(caches.keys().then(cachesNames => {
            cachesNames.map(cacheName => {
                /* Eliminamos lo que ya no se necesita en cache */
                if(cacheWhitelist.indexOf(cacheName) === -1){
                    return caches.delete(cacheName)
                }
            })
        })
    /* Le indica al SW activar el cache actual */
    .then(() => self.clients.claim()) 
    )
});


/* Es el que se encarga de recuperar todos los recursos del navegador,
es decir, cuando SI tengamos conexión vamos a recuperar los archivos
y también sirve para que si hay un cambio en el archivo que está leyendo
del servidor con la versión que tiene en el cache, se actualiza */
self.addEventListener('fetch', function(event) {
    event.respondWith(
      caches.match(event.request)
        .then(function(response) {
          // Cache hit - return response
          if (response) {
            return response;
          }
          return fetch(event.request);
        }
      )
    );
  });