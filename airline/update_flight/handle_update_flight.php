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

            $a = $_POST['airline'];
            $f = $_POST['flight'];
            $t = $_POST['time'];

            $query = "UPDATE flight SET DepartureActualTime=\"".$t."\" WHERE FlightNumber=\"".$f."\" AND AirlineCode=\"".$a."\"";
            $numRows = $connection->exec($query);
        ?>
        <div class="container">
            <?php
                $page = "UPDATE_FLIGHT"; 
                include '../nav.php'; 
            ?>
            
            <h2>Flight updated</h2>
            <p>Succesfully updated the actual departure time of flight <?php echo $a." - ".$f?> to <?=$t?>.</p>
            <p>Update a new flight <a href="/airline/update_flight">here</a> or return <a href="/airline">home</a>.</p>

        </div>
        
        <?php
            $connection = NULL;
        ?>
    </body>
</html>
