<?php
    include "database.php";
    $sql = "SELECT * FROM `class`";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // echo 'calss :'. $row['className'];
                // echo '<select name="" id="">';    
                echo '<option value="'.$row['className'].'">'.$row['className'].'</option>';
                // echo '</select>';
            }
        }
    }
?>



