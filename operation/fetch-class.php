<?php
    include "../includes/database.php";
    include "_auth.php";
    $apikey = $_POST['api'];
    if (authentication($apikey)) {
    $sql = "SELECT * FROM `class`";
    $r = mysqli_query($connect, $sql);
    if ($r) {
        if (mysqli_num_rows($r) > 0) {
            $row = mysqli_fetch_all($r, MYSQLI_ASSOC);
            echo json_encode($row);
        }
    }
    }

?>