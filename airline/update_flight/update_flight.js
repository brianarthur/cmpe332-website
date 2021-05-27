var airline = null;
var flight = null;

function updateAirline(a) {
    airline = a;
    flight = null;
    document.getElementById("flight_number_div").innerHTML = "";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("flight_number_div").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "/airline/api/get_flight_number.php?a="+airline, true);
    xhttp.send();
}

function updateFlight(f) {
    flight = f;
    document.getElementById("flight_time_div").innerHTML = "";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("flight_time_div").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "/airline/api/get_flight_times.php?a="+airline+"&f="+flight, true);
    xhttp.send();
}