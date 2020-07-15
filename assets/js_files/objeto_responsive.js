const d = document,
    w = window;

/* mq de mediaquery */
export default function responsiveMedia(id,mq,mobileContent,desktopContent){
    let breakpoint = w.matchMedia(mq);

    const responsive = (e) => {
        if(e.matches){ /* Cuando la media query se cumpla devuelve un true */
            d.getElementById(id).innerHTML = desktopContent;
        }else{
            d.getElementById(id).innerHTML = mobileContent;
        }

    console.log(breakpoint, e.matches);
    }

    
    breakpoint.addListener(responsive); /* EL addlistener hace que no se cargue la función event handler
    hasta que no se produczca un cambio en cuanto al e.matches */

    responsive(breakpoint);
}