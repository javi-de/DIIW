window.onload=function(){
    if(!localStorage.getItem('aviso')){
        document.getElementById("aviso").style.display="block";
    }
}

function encender(){
    if(document.getElementById("contacto").style.display=="block"){
        document.getElementById("contacto").style.display="none";
    } else {
        document.getElementById("contacto").style.display="block";
    }
}

function aceptar(){
    localStorage.setItem('aviso',"hola");
    document.getElementById("aviso").style.display="none";
}

function color(){
    let caja=document.getElementsByClassName("caja");
    document.getElementById("titulo").style.backgroundColor="white";
    document.getElementById("titulo").style.color="black";
    for (const iterator of caja) {
        iterator.style.color="black";
        iterator.style.backgroundColor="white";
    }

    
}