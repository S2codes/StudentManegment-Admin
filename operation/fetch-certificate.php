    <?php
        include "../includes/database.php";
        include "_auth.php";
        $apikey = $_POST['api'];
        $class = $_POST['class'];
        $sn = 1;
        $err = array(["Name" => false]);
        $studentData = array();
        if (authentication($apikey)) {
        $sql = "SELECT * FROM `certificate` WHERE `class` = '$class' ORDER BY `certificate`.`roll` ASC";
        $result = mysqli_query($connect, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                
                    $tempdata = array (
                        "sn" => $sn,
                        "Id" => $row['id'],
                        "Name" => $row['student'],
                        "Certificate" => $row['certificateName'],
                        "Class" => $row['class'],
                        "Roll" => $row['roll'],
                        "status" => $row['status'],

                    );
                    array_push($studentData, $tempdata);
                    $sn += 1;
                }
                echo json_encode($studentData);
            }else{
                echo json_encode($err);
                // echo "here";
            }
        }else{
            echo json_encode($err);
            // echo "here 2";
        }
    }
    ?>