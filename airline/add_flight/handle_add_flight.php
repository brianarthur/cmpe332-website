<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Airline App</title>
        <link rel="stylesheet" href="/airline/styles.css">
        <link rel="icon" href="/airline/airplane-icon.png">
    </head>
    <body>
        <?php
            include '../connectdb.php';

            $airline = $_POST["airline"];
            $airplane = $_POST["airplane"];
            $departureAirport = $_POST["departureAirport"];
            $arrivalAirport = $_POST["arrivalAirport"];
            $flightNumber = $_POST["flightNumber"];
            $departureTime = $_POST["departureTime"];
            $arrivalTime = $_POST["arrivalTime"];
            $daysAvailable = $_POST["daysAvailable"];

            $query = "INSERT INTO flight(FlightNumber, AirlineCode, AirplaneId, DepartureAirport, 
                DepartureScheduledTime, DepartureActualTime, ArrivalAirport, ArrivalScheduledTime, ArrivalActualTime) 
                VALUES ('".$flightNumber."', '".$airline."', '".$airplane."', '".$departureAirport."', '".$departureTime."', '".$departureTime."',
                '".$arrivalAirport."', '".$arrivalTime."', '".$arrivalTime."')";
            
            $numRows = $connection->exec($query);

            foreach ($daysAvailable as $day) {
                $query = "INSERT INTO flightdays(FlightNumber, AirlineCode, Day) VALUES ('".$flightNumber."', '".$airline."', '".$day."')";
                $numRows = $connection->exec($query);
            }

            $query = "SELECT * FROM airport WHERE AirportCode='".$departureAirport."'";
            $result = $connection->query($query);
            while ($row = $result->fetch()) {
                $departureAirport = $row['City'];
            }

            $query = "SELECT * FROM airport WHERE AirportCode='".$arrivalAirport."'";
            $result = $connection->query($query);
            while ($row = $result->fetch()) {
                $arrivalAirport = $row['City'];
            }
        ?>
        <div class="container">
            <?php
                $page = "ADD_FLIGHT"; 
                include '../nav.php'; 
            ?>

            <p>Added flight <?php echo $airline." - ".$flightNumber." from ".$departureAirport." to ".$arrivalAirport ; ?>.</p>

            <p>Add a new flight <a href="/airline/add_flight">here</a> or return <a href="/airline">home</a>.</p>
        
        </div>
        <?php
            $connection = NULL;
        ?>
    </body>
</html>
