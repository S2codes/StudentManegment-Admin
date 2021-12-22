<?php
// show last roll no 
include "../includes/database.php";
include "_auth.php";
$class = $_POST['classVal'];
$apikey = $_POST['api'];
if (authentication($apikey)) {
    $s = "SELECT * FROM `students` WHERE class = '$class'";
    $r = mysqli_query($connect, $s);
    if (mysqli_num_rows($r) > 0) {
        $sql = "SELECT `roll` FROM `students` WHERE class = '$class' ORDER BY `students`.`id` DESC LIMIT 1";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($roll = mysqli_fetch_assoc($result)) {;
                    if ($roll != 0) {
                        echo  $roll['roll'];
                    } else {
                        echo '1';
                    }
                }
            }
        } else {
            echo '1';
        }
    } else {
        echo 0;
    }
}

?>
