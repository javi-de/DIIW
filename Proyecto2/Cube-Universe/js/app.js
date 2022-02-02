let menuBar;
let body;

let navPrincipal;
let navTienda;
let navContacta;
let navQuienesSomos;

let eleMain;
let eleShop;
let eleContacUs;
let eleWhoWeAre

let ele_nav;

let butFondo;

window.onload
{
    menuBar= document.getElementById("menu_bar");
    navPrincipal= document.getElementById("principal");
    navTienda= document.getElementById("tienda");
    navContacta= document.getElementById("contacta");
    navQuienesSomos= document.getElementById("quienesSomos");

    ele_nav= document.getElementById("nav");

    butFondo= document.getElementById("butFondo");

    eleMain= document.getElementById("main");
    eleShop= document.getElementById("shop");
    eleContacUs= document.getElementById("contactUs");
    eleWhoWeAre= document.getElementById("whoWeAre");

    body= document.body;

    //listener para que al pulsar el boton butFondo, se cambien los colores
    butFondo.addEventListener("click", cambiarFondo);

    //listener para mostrar/ocultar la barra de navegacion
    menuBar.addEventListener("click", mostrar);

    //listeners para mostrar/ocultar la barra de navegacion al pinchar alguna opcion (Principal, Tienda, Contacta, Quienes somos)
    navPrincipal.addEventListener("click", ocultar);
    navTienda.addEventListener("click", ocultar);
    navContacta.addEventListener("click", ocultar);
    navQuienesSomos.addEventListener("click", ocultar);

    //listeners para mostrar la informacion de cada apartado y ocultar el resto
    navPrincipal.addEventListener("click", mostrarPrincipal);
    navTienda.addEventListener("click", mostrarTienda);
    navContacta.addEventListener("click", mostrarContacta);
    navQuienesSomos.addEventListener("click", mostrarQuienesSomos);

    //aviso legal
    if(!localStorage.getItem('aviso')){
        document.getElementById("aviso").style.display="block";
    }

}

//listener para que al pulsar el boton butFondo, se cambien los colores
var fondo= 0; 
//fondo= 0 -> fondo oscuro 
//fondo= 1 -> fondo claro

function cambiarFondo(){
    if(fondo== 0){
        
        body.style.opacity = 0;
        body.style.transition = "opacity .5s";
        
        setTimeout(() => {
            body.style.setProperty("background-image", "url('./img/fondoClaro.jpg')");

            eleMain.style.setProperty("background", "darkgrey");
            eleMain.style.setProperty("color", "black");
            eleShop.style.setProperty("background", "darkgrey");
            eleShop.style.setProperty("color", "black");
            eleContacUs.style.setProperty("background", "darkgrey");
            eleContacUs.style.setProperty("color", "black");
            eleWhoWeAre.style.setProperty("background", "darkgrey");
            eleWhoWeAre.style.setProperty("color", "black");

            butFondo.style.setProperty("background", "black");
            butFondo.style.setProperty("color", "white");

            body.style.opacity = 1;
        }, 1);
        
        fondo= 1;
    }else{
        body.style.setProperty("background-image", "url('./img/fondoOscuro.jpg')");

        eleMain.style.setProperty("background", "black");
        eleMain.style.setProperty("color", "white");
        eleShop.style.setProperty("background", "black");
        eleShop.style.setProperty("color", "white");
        eleContacUs.style.setProperty("background", "black");
        eleContacUs.style.setProperty("color", "white");
        eleWhoWeAre.style.setProperty("background", "black");
        eleWhoWeAre.style.setProperty("color", "white");

        butFondo.style.setProperty("background", "white");
        butFondo.style.setProperty("color", "black");

        fondo= 0;
    }
}



//listener para mostrar/ocultar la barra de navegacion

var counter= 0;

function mostrar(){
    if(counter== 1){
        ele_nav.style.setProperty("animation", "openNav 1s forwards");
        menuBar.style.setProperty("animation", "maximMenuBar 1s forwards");
        counter= 0;
        //console.log("hola");
    }else{
        ele_nav.style.setProperty("animation", "closeNav 1s forwards");
        menuBar.style.setProperty("animation", "minimMenuBar 1s forwards");
        counter= 1;
        //console.log("adios");
    }
}

//listeners para mostrar/ocultar la barra de navegacion al pinchar alguna opcion (Principal, Tienda, Contacta, Quienes somos)
function ocultar(){
    ele_nav.style.setProperty("animation", "closeNav 1s forwards");
    menuBar.style.setProperty("animation", "minimMenuBar 1s forwards");
    counter= 1;
}



//listeners para mostrar la informacion de cada apartado y ocultar el resto
let main= document.getElementById("main");
let shop= document.getElementById("shop");
let contactUs= document.getElementById("contactUs");
let whoWeAre= document.getElementById("whoWeAre");

function mostrarPrincipal(){
    main.style.setProperty("display", "block");
    shop.style.setProperty("display", "none");
    contactUs.style.setProperty("display", "none");
    whoWeAre.style.setProperty("display", "none");
}

function mostrarTienda(){
    main.style.setProperty("display", "none");
    shop.style.setProperty("display", "block");
    contactUs.style.setProperty("display", "none");
    whoWeAre.style.setProperty("display", "none");
}

function mostrarContacta(){
    main.style.setProperty("display", "none");
    shop.style.setProperty("display", "none");
    contactUs.style.setProperty("display", "block");
    whoWeAre.style.setProperty("display", "none");
}

function mostrarQuienesSomos(){
    main.style.setProperty("display", "none");
    shop.style.setProperty("display", "none");
    contactUs.style.setProperty("display", "none");
    whoWeAre.style.setProperty("display", "block");
}




//aviso legal
function aceptarAvisoLegal(){
    localStorage.setItem("aviso","hola");
    document.getElementById("aviso").style.display="none";
}