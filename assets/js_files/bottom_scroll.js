const d = document,
    w = window;

export default function scrollTopButton(btn){
    const $scrollBtn = d.querySelector(btn);

    //Para resolver cuando queremos que se vea o no el botón
    w.addEventListener("scroll", (e) => {
    
    /* 
    Cualquiera de estas dos propiedades de document y window nos da el mismo nº,
    la única diferencia en si lo obtenemos desde el objeto window o desde la etiqueta
    HTML. Ese número corresponde con la distancia en la que estamos situados dentro de
    la pag hasta el top 0 (arriba del todo). Es decir arriba del todo indicaría 0.

    Esto no se suele utilizar para la barra horizontal ya que estaríamos hablando de una
    web de no responsive design.
    
    */
    console.log(w.pageYOffset,d.documentElement.scrollTop);

    /*
    Como el objeto window pertenece al BOM el cual no es estándar le indicamos
    al iniciar la variable que si el navegador no detecta dicho método, que lo
    obtenga del DOM que si es estándar en todos los navgeadores
    */
    let scrollTop = w.pageYOffset || d.documentElement.scrollTop;

    /* Cuando esta distancia supere los 600 pixeles entoncemos mostramos el botón */
    if(scrollTop > 600)
        $scrollBtn.classList.remove("hidden");
    else
        $scrollBtn.classList.add("hidden");
    
    });

    /* Cuando pulsemo click en el botón, mueve hacia arriba del todo de la web */
    d.addEventListener("click", (e) => {
        if(e.target.matches(btn)){
            /* El método scrollTo te posiciona dentro de la web donde le indiques */
            w.scrollTo({
                behavior: "smooth", //misma función del scroll: behavior del CSS
                top: 0, //muevete arriba del todo
                //si estuvieramos controlando el scroll en eje x podríamos poner también left: 0;
            });
        }
    });
}