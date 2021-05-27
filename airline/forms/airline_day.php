<form action='airline_day.php' method='post'>
    <select name='airline' id='airline'>
        <?php
            $result = $connection->query("SELECT * FROM airline ORDER BY Name ASC");
            while ($row = $result->fetch()) {
                if (isset($airline) & $airline==$row["AirlineCode"]) {
                    $opt = "<option value=".$row["AirlineCode"]." selected>".$row["AirlineCode"]." - ".$row["Name"]."</option>";
                } else {
                    $opt = "<option value=".$row["AirlineCode"].">".$row["AirlineCode"]." - ".$row["Name"]."</option>";
                }
                echo $opt;
            }
        ?>
    </select>

    <select name="day" id="day">
        <?php
            foreach ($DAYS as $d => $day) {
                if (isset($day_input) && $day_input==$d) {
                    $opt = "<option value=".$d." selected>".$day."</option>";
                } else {
                    $opt = "<option value=".$d.">".$day."</option>";
                }
                
                echo $opt;
            }
        ?>
    </select>
    <input type='submit' value='Get flights' />
</form>