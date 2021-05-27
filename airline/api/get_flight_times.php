<?php 

include '../connectdb.php';

$a = $_GET['a'];
$f = $_GET['f'];

$query = "SELECT DepartureScheduledTime, DepartureActualTime FROM flight WHERE AirlineCode=\"".$a."\" AND FlightNumber=\"".$f."\"";
$result = $connection->query($query);
while ($row = $result->fetch()) {
    $scheduled = $row["DepartureScheduledTime"];
    $actual = $row["DepartureActualTime"];
}

$connection = NULL;

?>

<p>Scheduled departure time for flight <?php echo $a." - ".$f ?> is <?=$scheduled?> and the current actual departure time is <?=$actual?>.</p>
<label for="time">Update actual departure time</label>
<input required type="time" name='time' id='time'>