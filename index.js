import scrollTopButton from "./assets/js_files/bottom_scroll.js";
import darkTheme from "./assets/js_files/tema_oscuro.js";
import responsiveMedia from "./assets/js_files/objeto_responsive.js";
import contactFormValidations from "./assets/js_files/validaciones_formulario.js";

const d = document;

/* Progressive Web Apps */
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
      navigator.serviceWorker.register('sw.js').then(function(registration) {
        // Registration was successful
        console.log('ServiceWorker registration successful with scope: ', registration.scope);
      }, function(err) {
        // registration failed :(
        console.log('ServiceWorker registration failed: ', err);
      });
    });
  }

d.addEventListener("DOMContentLoaded", (e) => {
    scrollTopButton(".scroll-top-btn");
    darkTheme(".dark-theme-btn","dark-mode");
    responsiveMedia("youtube","(min-width: 1024px)",
    `<a href="https://www.youtube.com/watch?v=YG7OAIshR6Y">Ver vídeo</a>`, 
    `<iframe width="560" height="315" src="https://www.youtube.com/embed/YG7OAIshR6Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`)

    responsiveMedia("youtube2","(min-width: 1024px)",
    `<a href="https://www.youtube.com/watch?v=OK0IYES6pcs">Ver vídeo</a>`, 
    `<iframe width="560" height="315" src="https://www.youtube.com/embed/OK0IYES6pcs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`)

    contactFormValidations();
});
