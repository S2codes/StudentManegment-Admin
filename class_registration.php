<?php include "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add New Class - Student Mangement System </title>
    <?php include "includes/database.php"; ?>

    <?php include "includes/head.php"; ?>
    <?php
if (isset($_POST['register'])) {

    $name  = mysqli_real_escape_string($connect, $_POST['cname']); 
    $details = mysqli_real_escape_string($connect, $_POST['details']);
    $fees = mysqli_real_escape_string($connect, $_POST['mfees']);
    // echo $name;
    $c = "SELECT * FROM `class` WHERE `className` = '$name'";
    $result = mysqli_query($connect, $c);

    if ($result) {
        echo " run query";
        if (mysqli_num_rows($result) == 0) {
            echo "Availabel for new class";
            $s = "INSERT INTO `class` (`className`, `classDetails`, `fees`) VALUES ('$name', '$details', '$fees')";
            if (mysqli_query($connect, $s)) {
                echo "<script>window.location='classes.php';</script>';
                </script>";
            } else {
                echo mysqli_error($connect);
            }
        } else {
            echo "<script>alert('Class already exists with same name');</script>";
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
                            <h3>Add New Class</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add New Class </li>
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
                        <form action='' method='POST' class="card-body" id="class-form">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="basicInput">Class Name</label>
                                        <input type="text" name='cname' class="form-control" id="basicInput" placeholder="Enter Class Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="helperText">Class Details</label></br>
                                        <small>Maximum 150 charecters*</small>
                                        <!-- <?php include "includes/package_template.php"; ?> -->
                                        <textarea style='height:200px' class="form-control" name='details' placeholder="Enter Class details" required></textarea>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="helperText">Monthly Fees</label></br>
                                        <input type="text" name='mfees' class="form-control" id="basicInput" placeholder="Enter Class Fees" required>
                                        </p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type='submit' name='register' class='btn btn-success'>Save</button>
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
</body>

</html>



