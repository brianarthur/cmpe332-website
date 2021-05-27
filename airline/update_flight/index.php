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
            include '../utils.php';
        ?>
        <div class="container">
            <?php 
                $page = "UPDATE_FLIGHT";
                include '../nav.php'; 
            ?>

            <h2>Update departure form</h2>
            <form action="handle_update_flight.php" method='post' class="flight">
                <label for="airline">Airline</label>
                <select required name='airline' id='airline' onchange="updateAirline(this.value)">
                    <option value="" disabled selected>-------</option>
                    <?php
                        $airlines = get_airlines($connection);
                        var_dump($airlines);
                        foreach ($airlines as $a) {
                            $opt = "<option value=".$a["AirlineCode"].">".$a["AirlineCode"]." - ".$a["Name"]."</option>";
                            echo $opt;
                        }
                    ?>
                </select><br>
                <div id="flight_number_div"></div>
                <div id="flight_time_div"></div>

                <div style="margin: 20px 0;">
                    <input type='submit' value='Update flight'>
                </div>
            </form>
        </div>
        
        <?php
            $connection = NULL;
        ?>

        <script src='update_flight.js'></script>
    </body>
</html>