<?php include "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/database.php"; ?>
    <?php
    //Removing
    if (isset($_POST['remove'])) {
        $id = $_GET['id'];
        $d = "DELETE FROM `students` WHERE `id` =  $id";
        if (mysqli_query($connect, $d)) {
            echo "<script>window.location='students.php';</script>";
        }
    }
    //Updating
    if (isset($_POST['update'])) {
        $id = $_GET['id'];
        $name = mysqli_real_escape_string($connect, $_POST['name']); 
        $parent = mysqli_real_escape_string($connect, $_POST['parent']);
        $gender = mysqli_real_escape_string($connect, $_POST['gender']);
        $dob = mysqli_real_escape_string($connect, $_POST['dob']);
        $ph = mysqli_real_escape_string($connect, $_POST['phone']);
        $add = mysqli_real_escape_string($connect, $_POST['address']);
        $class = mysqli_real_escape_string($connect, $_POST['class']);
        $roll = mysqli_real_escape_string($connect, $_POST['roll']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);

        $s = "SELECT * FROM `students` WHERE `id` = '$id'";
        $res = mysqli_query($connect, $s);
        if ($res) {
            $num = mysqli_num_rows($res);
            if (mysqli_num_rows($res) > 0) {
                $sql = "UPDATE `students` SET `name`='$name',`parents`='$parent',`dob`='$dob',`gender`= '$gender',`phone`='$ph',`email`='$email',`address`='$add',`class`='$class',`roll`= '$roll' WHERE `id` = $id";
                if(mysqli_query($connect, $sql)){
                    echo "<script>window.location='students.php';</script>";
                }else{
                    echo "<script>alert('update query failed');</script>";
                }
            } else {
                echo "<script>alert('Student did not registered ');</script>";
            }
        }
    }
    ?>
    <?php
    if (!isset($_GET['id'])) {
        echo "<script>window.location='customers.php';</script>";
    }
    $s = "SELECT * FROM `students` WHERE `id`='" . $_GET['id'] . "' ";
    $res = mysqli_query($connect, $s);
    $data = mysqli_fetch_assoc($res);
    ?>
    <title><?php echo $data['name']; ?> - Student information - Student Mangement System </title>


    <?php include "includes/head.php"; ?>
</head>
<style>
    .data-style {
        color: 1.1rem;
        color: black;
    }
</style>

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
                            <h3>Edit - <?php echo $data['name']; ?></h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Student Information Edit</li>
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

                        <form action='' method='POST' class="card-body" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="basicInput">Name</label>
                                        <input type="text" name='name' value="<?php echo $data['name']; ?>" class="form-control" id="basicInput" placeholder="Enter Customer Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Parent's Name</label>
                                        <input type="text" name='parent' value="<?php echo $data['parents']; ?>" class="form-control" id="basicInput" placeholder="Enter Customer Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Gender</label>
                                        <input type="text" name='gender' value="<?php echo $data['gender']; ?>" class="form-control" id="basicInput" placeholder="Enter Customer Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Date of Birth</label>
                                        <input type="date" name='dob' value="<?php echo $data['dob']; ?>" class="form-control" id="basicInput" placeholder="Enter Customer Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="basicInput">Phone</label>
                                        <input type="phone" class="form-control" value="<?php echo $data['phone']; ?>" name='phone' id="basicInput" placeholder="Enter Phone Number">
                                    </div>

                                    <div class="form-group">
                                        <label for="helperText">Address</label>
                                        <textarea class="form-control" name='address' placeholder="Enter Address"><?php echo $data['address']; ?></textarea>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="helperText">Class</label>
                                        <input type="text" name='class' value="<?php echo $data['class']; ?>" id="helperText" class="form-control" placeholder="UserID">

                                    </div>
                                    <div class="form-group">
                                        <label for="helperText">Roll No.</label>
                                        <input type="text" name='roll' value="<?php echo $data['roll']; ?>" id="helperText" class="form-control" placeholder="UserID">

                                    </div>
                                    <div class="form-group">
                                        <label for="helpInputTop">Email</label>
                                        <input type="email" value="<?php echo $data['email']; ?>" name='email' class="form-control" id="helpInputTop">
                                    </div>
                                
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type='submit' name='update' class='btn btn-success'>Update</button>
                                            <button type='submit' name='remove' class='btn btn-success'>Remove</button>
                                            <a href='students.php' class='btn btn-primary'>Back</a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>