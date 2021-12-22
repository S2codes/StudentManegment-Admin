<?php
    include "../includes/database.php";
    include "_auth.php";
    $apikey = $_POST['api'];
    $class = $_POST['class'];
    $sno = 1;
    $err = array(["Name" => false]);
    $studentData = array();
    if (authentication($apikey)) {
    $sql = "SELECT * FROM `students` WHERE class = '$class' ORDER BY `students`.`roll` ASC";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              
                $tempdata = array (
                    "Sno" => $sno,
                    "Id" => $row['id'],
                    "Name" => $row['name'],
                    "Parents" => $row['parents'],
                    "Class" => $row['class'],
                    "Roll" => $row['roll'],

                );
                array_push($studentData, $tempdata);
                $sno += 1;
            }
            echo json_encode($studentData);
        }else{
            echo json_encode($err);
        }
    }else{
        echo json_encode($err);
    }
}

?>