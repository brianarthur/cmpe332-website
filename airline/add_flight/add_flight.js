var airline = null;
var arrivalAirport = null;
var departureAirport = null;

const AIRPLANE_DIV_ID = "flight_airplane_div";
const AIRPLANE_API_URL = "/airline/api/get_airplanes.php"

function updateAirline(a) {
    airline = a;
    getAirplanes();
}

function updateDepartureAirport(a) {
    departureAirport = a;
    getAirplanes();
}

function updateArrivalAirport(a) {
    arrivalAirport = a;
    getAirplanes();
}

function getAirplanes() {
    if (airline && arrivalAirport && departureAirport) {
        document.getElementById(AIRPLANE_DIV_ID).innerHTML = "";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(AIRPLANE_DIV_ID).innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", AIRPLANE_API_URL+"?airline="+airline+"&a1="+arrivalAirport+"&a2="+departureAirport, true);
        xhttp.send();
    }
}