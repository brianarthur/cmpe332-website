<?php
    // ENSURE POST PARAMS ARE SET
    if (isset($_POST['day'])) {
        $day = $_POST['day'];
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
                $page = "DAY_AVG";
                include 'nav.php'; 
            ?>
            
            <div class="d-flex">
                <div style="flex: 1">
                    <h2>Flight numbers for <?=$DAYS[$day]?> </h2>
                    <?php
                        $query = "SELECT COUNT(*) as \"NumFlights\", AVG(t.NumSeats) as \"AvgSeats\" FROM flight f, flightdays d, airplane a, airplanetype t WHERE d.Day=\"".$day."\" AND f.FlightNumber=d.FlightNumber AND f.AirlineCode=d.AirlineCode AND a.AirplaneId=f.AirplaneId AND a.AirplaneType=t.AirplaneTypeName";
                        $result = $connection->query($query);
                        while ($row = $result->fetch()) {
                            echo "Number of flights: ".$row["NumFlights"];
                            echo "<br>";
                            echo "Average number of seats: ".floor($row["AvgSeats"]);
                            echo "<br>";
                        }
                    ?>
                </div>
                <div style="min-width: 40%">
                    <h2>Average seats</h2>
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