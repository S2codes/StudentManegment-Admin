<?php include "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add New Certificate - Student Mangement System </title>
    <?php include "includes/database.php"; ?>
    <?php include "includes/head.php";
    if (isset($_POST['upload'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // echo 'post uploaded';
            $class = mysqli_real_escape_string($connect, $_POST['class']); 
            $roll = mysqli_real_escape_string($connect, $_POST['roll']); 
            $name = mysqli_real_escape_string($connect, $_POST['sname']); 
            $certificate = mysqli_real_escape_string($connect, $_POST['certificates']); 

            $file = $_FILES['data'];
            $filename = $file['name'];
            $filepath = $file['tmp_name'];
            $fileerror = $file['error'];

            $satus =  mysqli_real_escape_string($connect, $_POST['stat']);

            if ($fileerror == 0) {
                $dest = 'certificate/' . $filename;
                move_uploaded_file($filepath, $dest);
            }
            $c = "SELECT * FROM `certificate` WHERE `class` = '$class' AND `roll` = '$roll' AND `certificateName` = '$certificate'";
            $result = mysqli_query($connect, $c);
            if ($result) {
                if (mysqli_num_rows($result) == 0) {
                    $sql = "INSERT INTO `certificate`(`certificateName`, `class`, `roll`, `student`, `file`, `status`) VALUES ('$certificate', '$class', '$roll', '$name', '$dest', '$satus')";
                    $res = mysqli_query($connect, $sql);
                    echo var_dump($res);
                    if ($res) {
                        echo "<script>window.location='certificate-all.php';</script>";
                    } else {
                        echo mysqli_error($connect);
                    }
                } else {
                    echo "<script>alert('File is already uploaded with same Roll No and class');</script>";
                }
            }
        }
    }
    ?>


    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
</head>

<body>
    <div id="app">
        <?php include "includes/sidebar.php"; ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Upload Certificate </h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">New Certificate</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Class Details</h4>
                        </div>

                        <form action='addNewcertificate.php' method='post' class="card-body" id="ascertificate-form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="basicInput">Class Name</label>
                                        <select name="class" id="classlist" class="form-control">
                                            <option value="false">Select class</option>
                                            <?php include "includes/classdrop.php"; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="helperText">Certificate Name</label></br>
                                        <select name="certificates" id="certf" class="form-control">
                                            <?php
                                            $sl = "SELECT * FROM `certificatedetails`";
                                            $rs = mysqli_query($connect, $sl);
                                            if ($rs) {
                                                while ($crt = mysqli_fetch_assoc($rs)) {
                                                    echo '<option value="' . $crt['certificateName'] . '">' . $crt['certificateName'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="helperText">Student Name</label></br>
                                        <!-- <input type="text" name="sname" class="form-control"> -->
                                        <select name="sname" id="studentlist" class="form-control">
                                            <option value="false">Select Student Name</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="helperText">Roll No</label></br>
                                        <input type="num" name="roll" id="stdroll" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="helperText">Upload file</label></br>
                                        <input type="file" name="data" id="datafile" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="stat">Status</label></br>
                                        <select name="stat" id="" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Disable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type='submit' name='upload' class='btn btn-success'>Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

            </div>
            <?php include "includes/footer.php"; ?>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        //CKEDITOR.replace( 'details' );
    </script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/certificate_opr.js"></script>


</body>

</html>