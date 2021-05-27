<?php 

include '../connectdb.php';

$airline = $_GET['airline'];
$a1 = $_GET['a1'];
$a2 = $_GET['a2'];

$options = "";

$query = "SELECT DISTINCT AirplaneId, Year, a.AirplaneType FROM airplane a, airportairplanetypes t 
            WHERE a.AirlineCode=\"".$airline."\" AND a.AirplaneType=t.AirplaneType AND (t.AirportCode=\"".$a1."\" OR t.AirportCode=\"".$a2."\")";

$result = $connection->query($query);
while ($row = $result->fetch()) {
    $opt = "<option value='".$row["AirplaneId"]."'>".$row["AirplaneType"]." (Y:".$row['Year'].")</option>";
    $options .= $opt;
}

$connection = NULL;

?>

<label for='airplane'>Airplane</label>
<select required name='airplane' id='airplane'>
    <option value='' selected disabled>----------</option>
    <?= $options ?>
</select>

