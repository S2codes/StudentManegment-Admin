<?php include "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Registration - Bctn </title>
    <?php include "includes/database.php"; ?>
    <?php
    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($connect, $_POST['name']);
        $parent = mysqli_real_escape_string($connect, $_POST['parent']);
        $dob = mysqli_real_escape_string($connect,$_POST['dob']);
        $file = $_FILES['photo'];
        $gender = mysqli_real_escape_string($connect,$_POST['gender']);
        $phone = mysqli_real_escape_string($connect,$_POST['phone']);
        $mail = mysqli_real_escape_string($connect,$_POST['email']);
        $addr = mysqli_real_escape_string($connect,$_POST['address']);
        $class = mysqli_real_escape_string($connect,$_POST['class']);
        $roll = mysqli_real_escape_string($connect,$_POST['roll']);
    
        $filename = $file['name'];
        $filepath = $file['tmp_name'];
        $fileerror = $file['error'];
    
        if ($fileerror == 0) {
            $dest = 'students/' . $filename;
            move_uploaded_file($filepath, $dest);
        }
    
        $sql = "INSERT INTO `students` (`name`, `parents`, `dob`, `photo`, `gender`, `phone`, `email`, `address`, `class`, `roll`) VALUES ('$name', '$parent', '$dob', '$dest', '$gender', '$phone', '$mail', '$addr', '$class', '$roll')";
    
    
        $result = mysqli_query($connect, $sql);
        if ($result) {
            echo "<script>window.location='students.php';</script>";
        }
    }
    ?>
    <?php include "includes/head.php"; ?>
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
                            <h3>Student Registration</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Student Registration</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Student Informations</h4>
                        </div>

                        <form action='student_registration.php' method='POST' class="card-body" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="basicInput">Name</label>
                                        <input type="text" name='name' class="form-control" placeholder="Enter Student Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Parent's Name</label>
                                        <input type="text" name='parent' class="form-control" placeholder="Enter Parents Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Date of Birth</label>
                                        <input type="date" name='dob' class="form-control" placeholder="Enter Date of Birth " required>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Student's Photo</label>
                                        <input type="file" name='photo' class="form-control" placeholder="Enter Student Passport size photo" accept="image/png, image/jpeg">
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Gender</label>
                                        <!-- <input type="date" name='name'  class="form-control" 
                                            placeholder="Enter Gender" required > -->
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Phone</label>
                                        <input type="tel" class="form-control" name='phone' placeholder="Enter Phone Number" required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="basicInput">Alternative Phone</label>
                                        <input type="number" class="form-control" value="" name='alternative_phone' 
                                            placeholder="Enter Alternative Number" required   >
                                    </div> -->
                                    <div class="form-group">
                                        <label for="basicInput">Email</label>
                                        <input type="text" class="form-control" value="" name='email' placeholder="Enter Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="helperText">Address</label>
                                        <textarea class="form-control" name='address' placeholder="Enter Address" required></textarea>
                                        </p>
                                    </div>



                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="basicInput">Class</label>
                                        <select name="class" id="class" class="form-control">
                                            <option value="falseselect" selected>Select The Class</option>
                                            <!-- <option value="1">Class 1</option>
                                                <option value="2">Class 2</option>
                                                <option value="3">Class 3</option> -->
                                            <?php include "includes/classdrop.php"; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="helperText">Roll No</label>
                                        <input type="number" id="roll" class="form-control" name='roll' placeholder="Enter Roll Number" required></input>
                                        </p>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button type='submit' name="submit" class='btn btn-success'>Submit</button>
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

    <script src="assets/js/main.js"></script>
    <script src="assets/js/process/jquery-3.6.0.min.js"></script>
    <script src="assets/process/registration.js"></script>

    <script>
        $(document).ready(function() {
            $('#class').on('change', () => {
                var className = $('#class').val();
                if (className != 'falseselect') {
                    fetch_roll(className);
                } else {
                    $('#roll').val('');
                }
            });

            function fetch_roll(dataVal) {
                $.ajax({
                    url: 'operation/fetch-roll.php',
                    data: {
                        'classVal': dataVal,
                        'api' : 'ss123'
                    },
                    type: 'post',
                    dataType: 'JSON',
                    success: function(data, status) {
                        var objdata = JSON.parse(data);
                        $('#roll').val(data + 1);
                    }

                });
            }


        });
    </script>
</body>

</html>


