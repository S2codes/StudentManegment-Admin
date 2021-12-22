<?php include "auth.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/database.php";?>
    <?php
        //Removing
        if(isset($_GET['remove'])){
            echo $_GET['remove'];
            $d="DELETE FROM `certificatedetails` WHERE `certificateName` = '".$_GET['remove']."' ";
            if(mysqli_query($connect,$d)){
                $sql = "DELETE FROM `certificate` WHERE `certificateName` = '".$_GET['remove']."'";
                if (mysqli_query($connect, $sql)) {
                    echo "<script>window.location='certificate.php';</script>";
                }
            }
        }
        //Updating
        if(isset($_POST['update'])){
            $cname = mysqli_real_escape_string($connect, $_POST['docName']);
            $cdet = mysqli_real_escape_string($connect, $_POST['docDetails']);
              $s = "UPDATE `certificatedetails` SET `certificateName`= '$cname',`certificateDetails`= '$cdet' WHERE `id` = '".$_GET['query_id']."' ";
                    if(mysqli_query($connect,$s)){
                        $as = "UPDATE `certificate` SET `certificateName`= '$cname' WHERE `certificateName`= '".$_GET['name']."'";
                        if (mysqli_query($connect, $as)) {
                            echo "<script>alert('Document Updated');
                        window.location='certificate.php';
                        </script>";
                        }
                    }
                else{
                    echo "<script>alert('Customer already exists with same phone number or userid');</script>";
                }
        
     
            }
       
    ?>
    <?php
        if(!isset($_GET['query_id'])){
            echo "<script>window.location='certificate.php';</script>";      
        }
        $s="SELECT * FROM `certificatedetails` WHERE `id`='".$_GET['query_id']."' ";
        $res=mysqli_query($connect,$s); 
        $data=mysqli_fetch_assoc($res);
    ?>
    <title>Edit Document - Student Mangement System </title>
    
    
    <?php include "includes/head.php";?>
</head>

<body>
    <div id="app">
        <?php include "includes/sidebar.php";?>
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
                            <h3>Document Details - <?php echo $data['certificateName']; ?></h3>
                            
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Document</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Document Informations</h4>
                            <p> <span style="color: red;">Note:</span> If you remove Documnet, all upload document named with - <?php echo $data['certificateName']; ?>, also delete</p>
                        </div>

                        <form action='' method='POST' class="card-body" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="basicInput"> Document Name</label>
                                        <input type="text" name='docName' value="<?php echo $data['certificateName'];?>" class="form-control" id="basicInput"
                                            placeholder="Enter Document Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Document Details</label>
                                        <input type="text" class="form-control" value="<?php echo $data['certificateDetails'];?>" name='docDetails' id="basicInput"
                                            placeholder="Enter Details ">
                                    </div>
                                    
                                </div>
                                
                                    
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type='submit' name='update' class='btn btn-success'>update</button>
                                            <a href='document_edit.php?remove=<?php echo $data["certificateName"] ?>' name ='remove' type="submit" class='btn btn-danger'>Remove</a>
                                            <a href='certificate.php' class='btn btn-primary'>Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

            </div>
            <?php include "includes/footer.php";?>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>