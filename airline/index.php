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

            if (isset($_GET['d'])) {
                $day_input = $_GET['d'];
            } else {
                $day_input = "MON";
            }
        ?>
        <div class="container">
            <?php 
                $page = "HOME";
                include 'nav.php'; 
            ?>

            <div class="d-flex">
                <div style="flex: 1">
                    <h2>Flights On Time</h2>
                    <div>
                        <?php
                            foreach ($DAYS as $d => $day) {
                                $class_name = "day-btn";
                                if ($d == $day_input) {
                                    $class_name .= " active";
                                }
                                echo "<a class='".$class_name."' href=/airline/?d=".$d.">".$day."</a>";
                            }
                        ?>
                    </div>
                    <?php
                        $flight_rows = "";
                        $query = "SELECT f.FlightNumber, f.AirlineCode, f.DepartureActualTime, f.ArrivalActualTime, f.DepartureAirport,
                                        a1.City as \"DepartureCity\", f.ArrivalAirport, a2.City as \"ArrivalCity\" 
                                    FROM flight f, flightdays d, airport a1, airport a2
                                    WHERE ArrivalScheduledTime=ArrivalActualTime AND f.FlightNumber=d.FlightNumber AND f.AirlineCode=d.AirlineCode 
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
                    <?php
                        include 'forms/airline_day.php';
                    ?>
                    <h2>Average seat numbers</h2>
                    <?php
                        include 'forms/day_avg.php';
                    ?>
                </div>
            </div>
        </div>
        <?php
            $connection = NULL;
        ?>
    </body>
</html>