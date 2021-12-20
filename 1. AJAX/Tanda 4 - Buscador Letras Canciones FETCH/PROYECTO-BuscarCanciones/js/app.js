import * as UI from "./interfaz.js";
import API from "./api.js";

console.log(UI);

//para utilizar el formulario buscar
UI.formularioBuscar.addEventListener("submit", buscarCancion);

function buscarCancion(e){
    e.preventDefault();

    const artista= document.querySelector("#artista").value;
    const cancion= document.querySelector("#cancion").value;

    //validacion de datos
    if(artista== "" || cancion== ""){
        //si se deja el campo artista o cancion vacio, mostrar mensaje de error
        UI.divMensajes.textContent= "Error: todos los campos son obligatorios";
        UI.divMensajes.classList.add("error");

        setTimeout(()=> {
            UI.divMensajes.innerHTML= "";
            UI.divMensajes.classList.remove("error");
        }, 3000);
    }else{
        //consultar la API
        console.log("Consultando la API");
        const busqueda= new API(artista, cancion);

        console.log(busqueda);
        
        if(!busqueda.consultarAPI()){
            //si no encuentra la canción o el autor, mostrar mensaje de error
            UI.divMensajes.textContent= "Error: cancion o artista desconocido";
            UI.divMensajes.classList.add("error");

            setTimeout(()=> {
                UI.divMensajes.innerHTML= "";
                UI.divMensajes.classList.remove("error");
            }, 3000);
        }

    }

}


