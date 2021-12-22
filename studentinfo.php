<?php include "auth.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/database.php";?>
    <?php
        //Removing
        if(isset($_GET['remove'])){
            $d="DELETE FROM `customers` WHERE `id`='".$_GET['remove']."' ";
            if(mysqli_query($connect,$d)){
                echo "<script>window.location='customers.php';</script>";
            }
        }
        //Updating
        if(isset($_POST['update'])){
            if(isset($_POST['phone']) && isset($_POST['userid'])){
                $c="SELECT * FROM `customers` WHERE `phone`= '".$_POST['phone']." ' && `userid`=' ".$_POST['userid']." ' ";
                $res=mysqli_query($connect,$c);
                if(mysqli_num_rows($res)>0){
                    $s="UPDATE `customers` SET `name`='".$_POST['name']."',`phone`='".$_POST['phone']."',`email`='".$_POST['email']."',`address`='".$_POST['address']."',`password`='".$_POST['password']."',`status`='".$_POST['status']."',`distributor`=' ".$_POST['distributor']." 'WHERE `id`='".$_GET['id']."' ";
                    if(mysqli_query($connect,$s)){
                        echo "<script>alert('Customer Updated');</script>";
                    }
                }else{
                    echo "<script>alert('Customer already exists with same phone number or userid');</script>";
                }
            }
        }
    ?>
    <?php
        if(!isset($_GET['id'])){
            echo "<script>window.location='customers.php';</script>";      
        }
        // $s="SELECT * FROM `customers` WHERE `id`='".$_GET['id']."' ";
        $s="SELECT * FROM `students` WHERE `id`='".$_GET['id']."' ";
        $res=mysqli_query($connect,$s);
        $data=mysqli_fetch_assoc($res);
        // while ($data=mysqli_fetch_assoc($res)) {
        //     # code...
        // }
    ?>
    <title><?php echo $data['name'];?> - Student information - Student Mangement System </title>
    
    
    <?php include "includes/head.php";?>
</head>
<style>
    .data-style{
        color: 1.1rem;
        color: black;
    }
</style>
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
                            <h3>Student Data - <?php echo $data['name'];?></h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Student Information</li>
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
                        <div class="mx-4 mb-2" style="width: 20%; ">
                            <!-- <img src="students/naruto.jpg" alt="" width="230"> -->
                            <img src="<?php echo $data['photo'];?>" alt="" width="230">
                            
                        </div>

                        <form action='' method='POST' class="card-body" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="basicInput">Name</label>
                                        <!-- <input type="text" name='name' value="<?php echo $data['name'];?>" class="form-control" id="basicInput"
                                            placeholder="Enter Customer Name"> -->
                                            <p class="data-style"><?php echo $data['name'];?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Parent's Name</label>
                                            <p class="data-style"><?php echo $data['parents'];?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Gender</label>
                                            <p class="data-style"><?php echo $data['gender'];?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Date of Birth</label>
                                            <p class="data-style"><?php echo $data['dob'];?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Phone</label>
                                            <p class="data-style"><?php echo $data['phone'];?></p>
                                    </div>
                                    

                                    
                                    <div class="form-group">
                                        <label for="helperText">Address</label>
                                         <p class="data-style"><?php echo $data['address'];?></p>
                                    </div>
                                 

                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                        <label for="helperText">Class</label>
                                        <p class="data-style"><?php echo $data['class'];?></p>
                                    </div>
                                <div class="form-group">
                                        <label for="helperText">Roll No</label>
                                        <p class="data-style"><?php echo $data['roll'];?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="helpInputTop">Contact</label>
                                        <p class="data-style"><?php echo $data['phone'];?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="helpInputTop">Email</label>
                                         <p class="data-style"><?php echo $data['email'];?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="helpInputTop">Date of Admission</label>
                                        <p class="data-style"><?php echo $data['date'];?></p>
                                    </div>
                                 
                                    
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <a href='student.php?id=<?php echo $data['id'];?>' class='btn btn-primary'>Edit</a>
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