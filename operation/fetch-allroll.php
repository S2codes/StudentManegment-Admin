<?php
// show last roll no 
    include "../includes/database.php";
    include "_auth.php";
    $apikey = $_POST['api'];
    $class =  mysqli_real_escape_string($connect, $_POST['cls']);
    $name = mysqli_real_escape_string($connect,  $_POST['std']);

    if (authentication($apikey)) {
        $sql = "SELECT `roll` FROM `students` WHERE `name` = '$name' AND `class` = '$class'";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($roll = mysqli_fetch_assoc($result) ) {
                    echo $roll['roll'];
    
                }
            }
        }
    }
 
?>