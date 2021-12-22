<?php include "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Certificate Upload - Student Mangement System </title>
    <?php include "includes/database.php"; ?>

    <?php include "includes/head.php"; 
    // add neew  certificate
    if (isset($_POST['addcert'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo 'btn click post';
            $certName = mysqli_real_escape_string($connect, $_POST['crtfname']);
            $certDetails = mysqli_real_escape_string($connect, $_POST['crtfdetails']);
            $s = "SELECT * FROM `certificatedetails` WHERE `certificateName` = '$certName'";
             $r = mysqli_query($connect, $s);
             if ($r) {
                 if (mysqli_num_rows($r) == 0) {
                    $sql = "INSERT INTO `certificatedetails` (`certificateName`, `certificateDetails`) VALUES ('$certName', '$certDetails')";
                    $result = mysqli_query($connect, $sql);
                    if ($result) {
                        echo '<script>alert("Certificate Name Added Successfully");
                        document.getElementById("certificate-info").reset();
                        </script>';       
                    }
                 }
             }else{
                 echo '<script>alert("Certificate Name Already Exits")</script>';
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
                                    <li class="breadcrumb-item active" aria-current="page">Certificate</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Certificate Name and Details</h4>
                            <p>Note : If you want to add new file then please first fill this form below</p>
                        </div>

                        <form action='certificate.php' method='POST' class="card-body" id="certificate-info"
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="helperText">Certificate Name</label></br>
                                        <input type="text" name="crtfname" id="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="helperText">Certificate Message</label></br>
                                        <input type="text" name="crtfdetails" id="" class="form-control">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type='submit' name='addcert' class='btn btn-info'>Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card-header">
                            <h4 class="card-title">All Documents</h4>
                        </div>

                        <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Document Name</th>
                                <th>Details</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   
                            $sn = 1;
                                        $s="SELECT * FROM `certificatedetails`";
                                        $res=mysqli_query($connect,$s);
                                        while($data=mysqli_fetch_array($res)){
                                            $id =$data['id'];
                                            echo "
                                            <tr>
                                            <td><a href='#'>".$sn."</a></td>
                                                <td><a href='#'>".$data['certificateName']."</a></td>
                                                <td><a href='#'>".$data['certificateDetails']."</a></td>
                                                <td><a href='document_edit.php?query_id=$id&name=".$data['certificateName']."' class= 'btn btn-info'>Edit</a></td>
                                            </tr>
                                            ";
                                            $sn += 1;
                                        }
                                        // package.php?id=".$data['id']."
                                    ?>
                        </tbody>
                    </table>
                </div>





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


