function loadJSON() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var JSONObject = JSON.parse(xhr.responseText);
            //console.log(JSONObject);

            eleTabla= document.getElementById("tabla");
            JSONObject.forEach(element => {
                eleTr= document.createElement("tr");

                eleTdCity= document.createElement("td");
                eleTdCity.innerHTML= element.city;

                eleTdDescription= document.createElement("td");
                eleTdDescription.innerHTML= element.description;

                eleTdRanking= document.createElement("td");
                eleTdRanking.innerHTML= element.ranking;

                eleTr.appendChild(eleTdCity);
                eleTr.appendChild(eleTdDescription);
                eleTr.appendChild(eleTdRanking);

                eleTabla.appendChild(eleTr);           
                
            });
            
        }
    }
    xhr.open("GET", "marcadores.json", true); 
    xhr.send();
}

window.onload = loadJSON;