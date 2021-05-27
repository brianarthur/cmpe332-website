<?php

$DAYS = array("MON"=>"Monday", "TUE"=>"Tuesday", "WED"=>"Wednesday", "THU"=>"Thursday", "FRI"=>"Friday", "SAT"=>"Saturday", "SUN"=>"Sunday");

function get_airlines($c) {
    $airlines = array();
    $result = $c->query("SELECT * FROM airline ORDER BY Name ASC");
    while ($row = $result->fetch()) {
        $airlines[] = $row;
    }
    return $airlines;
}

function get_airports($c) {
    $airports = array();
    $result = $c->query("SELECT * FROM airport ORDER BY City ASC");
    while ($row = $result->fetch()) {
        $airports[] = $row;
    }
    return $airports;
}

?>