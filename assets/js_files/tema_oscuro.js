export default function darkTheme(btn, classDark){
    /* Para no tener que estar indicando selecto por selector
    los cuales queremos a los que se le apliquen los colores oscuros,
    vamos a ayudarnos de un dataAtributte para añadirselo o no
    al elemento que queramos que se vuelva en modo oscuro 
    
    A todos los elementos que yo le quiera añadir el modo oscuro
    se lo añado como atributo en cada uno de los elementos HTML
    
    Nosotros se lo vamos a aplicar a la etiqueta html y la etiqueta body


    */

    /* Con el corchete le indicamos que vamos a aplicarle dicha regla
    a los atributos que tengan lo que indiquemos dentro.
    
    De esta forma como mencionamos antes, no necesitaríamos indicar a cada elemento
    que queramos que se le aplique el modo oscuro uno por uno que se le añada o elimine
    la clase que se usa para tal fin.
    
    El data-atributte nos ayuda a detectar automaticamente todos estos elementos y poder
    añadirle o eliminarle la clase del modo dark a todos de golpe.

    De hecho, frameworks como Bootstrap o Foundation no necesita que desencadenemos 
    la programación de sus componentes que tengan JS, sino que cuando pegamos los componentes del código
    de Bootstrap ya funcionan, pero si nos fijamos en algunos de sus componentes, utilizan
    también este data-"lo que sea" para hacer el mismo funcionamiento que estamos realizando
    nosotros con este ejemplo.


    */
    
    const d = document;
    
    const $themeBtn = d.querySelector(btn),
        $selectors = d.querySelectorAll("[data-dark]");
    
    /* Nos imprime un NodeList con las etiquetas html y body que son las que tienen 
    el atributo data-dark */
    console.log($selectors);

    /* Cuando presionemos el botón a parte de agregar o eliminar la clase oscura,
    tenemos que cambiar el icono */
    let moon = "🌛",
        sun = "🌞";

    d.addEventListener("click", e => {
        
        if(e.target.matches(btn)){
            /* Imprimimos el contenido textual que tienen aquel elemento
            con clase btn, es decir si miramos en index_dom el parámetro es
            dark-theme-btn e imprimirá la luna*/
            console.log($themeBtn.textContent);
            if($themeBtn.textContent === moon){
                /* Ahora usamos el método forEach para recorrer el NodeList */
                $selectors.forEach(el => el.classList.add(classDark));
                $themeBtn.textContent = sun;
            }
            else{
                $selectors.forEach(el => el.classList.remove(classDark));
                $themeBtn.textContent = moon;
            }

        }
    });
}