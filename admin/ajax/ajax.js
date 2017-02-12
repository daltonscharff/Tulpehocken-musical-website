function ajaxNoResponse(fileName){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var returned = xhttp.responseText;
        }
    };
	xhttp.open("GET", "../ajax/" + fileName, true);
	xhttp.send(); 
}

function ajaxNoResponse(fileName, redirect){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
			var returned = xhttp.responseText;
			if(returned.length == 0){
				window.location = redirect;
			}		
			console.log(returned);
        }
    };
	xhttp.open("GET", "../ajax/" + fileName, true);
	xhttp.send(); 
}

function ajaxErrorResponse(fileName, redirect){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var returned = xhttp.responseText;
			if(returned.length == 0){
				window.location = redirect;
			}
			document.getElementById("error").innerHTML = returned;
        }
    };
	xhttp.open("GET", "../ajax/" + fileName, true);
	xhttp.send();
}

function ajaxAddSession(variableName, value){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var returned = xhttp.responseText;
        }
    };
	xhttp.open("GET", "../ajax/addSession.php?variableName=" + variableName + "&value=" + value, true);
	xhttp.send();
}

function ajaxTableResponse(fileName, str, filterNames, filterValues){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			if(xhttp.responseText == "error"){
				document.getElementById("SearchData").innerHTML = "<p id='error'>No results found.</p>";
			}else if(xhttp.responseText != ""){
				document.getElementById("SearchData").innerHTML = xhttp.responseText;
				//console.log(xhttp.responseText);
			}
		}
	};
	var fileToSend = "../ajax/" + fileName + "?searchString=" + str;
	var i = 0;
	for(i = 0; i < filterNames.length; i++){
		fileToSend += "&" + filterNames[i] + "=" + filterValues[i];
	}
	xhttp.open("GET", fileToSend, true);
	xhttp.send();
}