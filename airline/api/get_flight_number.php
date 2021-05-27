<?php 

include '../connectdb.php';

$a = $_GET['a'];

$options = "";

$query = "SELECT FlightNumber FROM flight WHERE AirlineCode=\"".$a."\" ORDER BY FlightNumber ASC";
$result = $connection->query($query);
while ($row = $result->fetch()) {
    $opt = "<option value='".$row["FlightNumber"]."'>".$a." - ".$row["FlightNumber"]."</option>";
    $options .= $opt;
}

$connection = NULL;

?>

<label for='flight'>Flight Number</label>
<select required name='flight' id='flight' onchange="updateFlight(this.value)">
    <option value='' selected disabled>----------</option>
    <?= $options ?>
</select>

