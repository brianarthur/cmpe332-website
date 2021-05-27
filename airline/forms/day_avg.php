<?php    
    if(isset($_POST["day"])) {
        $day_input = $_POST["day"];
    } else {
        $day_input = false;
    }
?>
<form action="day_avg.php" method='post'>
    <select name="day" id="day">
        <?php
            foreach ($DAYS as $d => $day) {
                if ($day_input and $day_input == $d) {
                    $opt = "<option value=".$d." selected>".$day."</option>";
                } else {
                    $opt = "<option value=".$d.">".$day."</option>";
                }
                
                echo $opt;
            }
        ?>
    </select>
    <input type='submit' value='Get average seats' />
</form>