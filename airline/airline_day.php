<?php
    // ENSURE POST PARAMS ARE SET
    if (isset($_POST['airline']) & isset($_POST['day'])) {
        $airline = $_POST['airline'];
        $day_input = $_POST['day'];
    } else {
        header("Location: /airline");
    }

?>

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
            include 'connectdb.php';
            include 'utils.php';
        ?>
        <div class="container">
            <?php 
                $page = "AIRLINE";
                include 'nav.php'; 
            ?>
            
            <div class="d-flex">
                <div style="flex: 1">
                <?php
                     $query = "SELECT Name FROM airline WHERE AirlineCode=\"".$airline."\"";
                     $result = $connection->query($query);
                     while ($row = $result->fetch()) {
                        $airlineName = $row["Name"];
                    }
                ?>
                    <h2><?php echo $airlineName." flights on ".$DAYS[$day_input]?></h2>
                    <?php
                        $flight_rows = "";
                        $query = "SELECT f.FlightNumber, f.AirlineCode, f.DepartureActualTime, f.ArrivalActualTime, f.DepartureAirport, 
                                        a1.City AS \"DepartureCity\", f.ArrivalAirport, a2.City AS \"ArrivalCity\" 
                                    FROM flight f, flightdays d, airport a1, airport a2
                                    WHERE f.FlightNumber=d.FlightNumber AND f.AirlineCode=d.AirlineCode AND f.AirlineCode=\"".$airline."\"
                                    AND d.Day=\"".$day_input."\" AND DepartureAirport=a1.AirportCode AND ArrivalAirport=a2.AirportCode";
                        $result = $connection->query($query);
                        while ($row = $result->fetch()) {
                            $flight_rows .= "
                                <tr>
                                    <td>".$row["AirlineCode"]." - ".$row["FlightNumber"]."</td>
                                    <td>".$row["DepartureActualTime"]."</td>
                                    <td>".$row["ArrivalActualTime"]."</td>
                                    <td>".$row["DepartureAirport"]."</td>
                                    <td>".$row["DepartureCity"]."</td>
                                    <td>".$row["ArrivalAirport"]."</td>
                                    <td>".$row["ArrivalCity"]."</td>
                                </tr>";
                        }
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Flight Code</th>
                                <th>Departure Time</th>
                                <th>Arrival Time</th>
                                <th colspan=2>Derparture Airport</th>
                                <th colspan=2>Arrival Airport</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?=$flight_rows ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <h2>See airline flights</h2>
                    <?php include 'forms/airline_day.php'; ?>
                </div>
            </div>
        </div>
        <?php
            $connection = NULL;
        ?>
    </body>
</html>