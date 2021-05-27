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
            $airlines = get_airlines($connection);
            $airports = get_airports($connection);
        ?>
        <div class="container">
            <?php 
                $page = "ADD_FLIGHT";
                include '../nav.php'; 
            ?>

            <h2>Add flight form</h2>
            <form action="handle_add_flight.php" method='post' class="flight">
                <div>
                    <label for="airline">Airline</label>
                    <select required name='airline' id='airline' onchange="updateAirline(this.value)">
                        <option value="" disabled selected>-------</option>
                        <?php
                            foreach ($airlines as $a) {
                                $opt = "<option value=".$a["AirlineCode"].">".$a["AirlineCode"]." - ".$a["Name"]."</option>";
                                echo $opt;
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="departureAirport">Departure Airport</label>
                    <select required name='departureAirport' id='departureAirport' onchange="updateDepartureAirport(this.value)">
                        <option value="" disabled selected>-------</option>
                        <?php
                            foreach ($airports as $a) {
                                $opt = "<option value=".$a["AirportCode"].">".$a["City"]."</option>";
                                echo $opt;
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="arrivalAirport">Arrival Airport</label>
                    <select required name='arrivalAirport' id='arrivalAirport' onchange="updateArrivalAirport(this.value)">
                        <option value="" disabled selected>-------</option>
                        <?php
                            foreach ($airports as $a) {
                                $opt = "<option value=".$a["AirportCode"].">".$a["City"]."</option>";
                                echo $opt;
                            }
                        ?>
                    </select>
                </div>
                <div id="flight_airplane_div">
                    <label for='airplane'>Airplane</label>
                    <select required name='airplane' id='airplane'>
                        <option value='' selected disabled>----------</option>
                    </select>
                </div>
                <div>
                    <label for="flightNumber">Flight Number</label>
                    <input required type="text" id="flightNumber" name="flightNumber">
                </div>
                <div>
                    <label for="departureTime">Departure Time</label>
                    <input required type="time" id="departureTime" name="departureTime">
                </div>
                <div>
                    <label for="arrivalTime">Arrival Time</label>
                    <input required type="time" id="arrivalTime" name="arrivalTime">
                </div>
                <div style="white-space: nowrap">
                    <p>Days Available</p>
                    <?php 
                        $i = 0;
                        foreach($DAYS as $d => $day) {
                            $label = 'day'.$i;
                            echo "<span style='padding-right: 10px'>";
                            echo "<input type='checkbox' id='".$label."' name='daysAvailable[]' value='".$d."'>";
                            echo "<label for='".$label."'>".$day."</label>";
                            echo "</span>";
                            $i += 1;
                        }
                    ?>
                    
                </div>
                
                <div style="margin: 20px 0;">
                    <input type='submit' value='Add flight'>
                </diV>
            </form>
        </div>
        <?php
            $connection = NULL;
        ?>

        <script src='add_flight.js'></script>
    </body>
</html>