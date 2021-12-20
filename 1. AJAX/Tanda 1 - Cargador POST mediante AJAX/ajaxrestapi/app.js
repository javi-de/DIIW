function loadJSON() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var JSONObject = JSON.parse(xhr.responseText);
            //console.log(JSONObject);

            JSONObject.forEach(element => {
                document.getElementById("listado").innerHTML += "userId: " + element.userId + "<br>";
                document.getElementById("listado").innerHTML += "id: " + element.id + "<br>";
                document.getElementById("listado").innerHTML += "title: " + element.title + "<br>";
                document.getElementById("listado").innerHTML += "body: " + element.body + "<br><br>";
            });
            
        }
    }
    xhr.open("GET", "http://jsonplaceholder.typicode.com/posts", true); 
    xhr.send();
}
