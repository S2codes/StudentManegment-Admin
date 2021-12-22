<?php include "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/database.php"; ?>
    <?php
    //Removing
    if (isset($_POST['remove'])) {
        $d = "DELETE FROM `certificate` WHERE `class` = '".$_POST['scls']."' AND `roll` = '" . $_GET['query_roll'] . "' ";
        if (mysqli_query($connect, $d)) {
            echo "<script>window.location='certificate-all.php';</script>";
        }
    }
    //Updating
    if (isset($_POST['save'])) {
        $file = $_FILES['upfile'];
        $filename = $file['name'];
        $filepath = $file['tmp_name'];
        $fileerror = $file['error'];

        if ($fileerror == 0) {
            $fdest = 'certificate/' . $filename;
            echo $fdest . "<br> ";
            move_uploaded_file($filepath, $fdest);
        }
        if ($file['error'] == 4) {
            $s = "UPDATE `certificate` SET `certificateName`='" . $_POST['certf'] . "', `status`='" . $_POST['cstat'] . "' WHERE `class` = '" . $_POST['scls'] . "' AND `roll` = '" . $_GET['query_roll'] . "'";
        } else {
            $s = "UPDATE `certificate` SET `certificateName`= '" . $_POST['certf'] . "',`file`='$fdest',`status`= '" . $_POST['cstat'] . "' WHERE `class` = '" . $_POST['scls'] . "' AND `roll` = '" . $_GET['query_roll'] . "' ";
        }
        if (mysqli_query($connect, $s)) {
            echo "<script>window.location='certificate-all.php'</script>";
        }
    }

    ?>
    <?php
    if (!isset($_GET['query_roll'])) {
        echo "<script>window.location='certificate-all.php';</script>";
    }
    $s = "SELECT * FROM `certificate` WHERE `class` = '". $_GET['class']."' AND `roll` = '" . $_GET['query_roll'] . "' ";
    $res = mysqli_query($connect, $s);
    $data = mysqli_fetch_assoc($res);
    ?>
    <title>Edit Certificate - Student Mangement System </title>


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
                            <h3>Edit Certificate - <?php echo $data['student']; ?></h3>

                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Certificate</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Certificate Information</h4>
                        </div>

                        <form action='' method='POST' class="card-body" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="basicInput"> Certificate Name</label>
                                        <select name="certf" class="form-control">
                                            <?php
                                            $sq = "SELECT `certificateName` FROM `certificatedetails`";
                                            $rs = mysqli_query($connect, $sq);
                                            if ($rs) {
                                                while ($d = mysqli_fetch_assoc($rs)) {
                                                    if ($data['certificateName'] == $d['certificateName']) {
                                                        echo '<option value="' . $d['certificateName'] . '" selected>' . $d['certificateName'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $d['certificateName'] . '">' . $d['certificateName'] . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Class</label>
                                        <input type="text" class="form-control" value="<?php echo $data['class']; ?>" name='scls' id="basicInput" readonly>
                                    </div>


                                    <div class="form-group">
                                        <label for="basicInput">Certificate</label>
                                        <input type="file" name='upfile' class="form-control" value="<?php echo $data['file']; ?>" id="basicInput" placeholder="Enter Package Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Status</label>
                                        <select name="cstat" id="" class="form-control">
                                            <?php
                                            if ($data['status'] == 1) {
                                                echo '<option value="1" selected>Active</option>
                                                <option value="0">Disable</option>';
                                            } elseif ($data['file'] == 0)
                                                echo '<option value="1" >Active</option>
                                                <option value="0" selected>Disable</option>';
                                            ?>
                                        </select>
                                    </div>


                                </div>


                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type='submit' name='save' class='btn btn-success'>Save</button>
                                        <button name ='remove'  class='btn btn-danger'>Remove</button>
                                        <a href='certificate-all.php' class='btn btn-primary'>Back</a>
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