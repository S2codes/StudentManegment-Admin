<?php
        include "../includes/database.php";
        include "_auth.php";
        $apikey = $_POST['api'];
        $class = $_POST['class'];
        $roll = $_POST['roll'];
        $err = array(["Name" => 'false']);
        $err2 = array(["Name" => 'false2']);
        $studentData = array();
        if (authentication($apikey)) {
        $sql = "SELECT * FROM `certificate` WHERE `class` = '$class' AND `roll` = '$roll'";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                $s= "SELECT * FROM `certificatedetails` WHERE `certificateName` = '".$row['certificateName']."' ";
                $r =mysqli_query($connect, $s); 
                if ($r) {
                    $certfDet = mysqli_fetch_assoc($r); 
                    $detals = $certfDet['certificateDetails'];
                }
                    $tempdata = array (
                        // "sn" => $sn,
                        // "Id" => $row['id'],
                        // "Roll" => $row['roll'],
                        // "Name" => $row['student'],
                        // "Class" => $row['class'],
                        "status" => $row['status'],
                        "Certificate" => $row['certificateName'],
                        "certificateMsg" => $detals,
                        "document" => $row['file']

                    );
                    array_push($studentData, $tempdata);
                    // $sn += 1;
                }
                echo json_encode($studentData);
            }else{
                echo json_encode($err);
                // echo "here";
            }
        }else{
            echo json_encode($err2);
            // echo "here 2";
        }
    }
    ?>