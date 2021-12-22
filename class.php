<?php include "auth.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer Registration - Perfect </title>
    <?php 
    include "includes/database.php";

    if(!isset($_GET['id'])){
        echo "<script>window.location='packages.php';</script>";
    }
    // remove 
        if(isset($_POST['remove'])){
            $s="DELETE FROM `class` WHERE `id` = '".$_GET['id']."' ";
            if(mysqli_query($connect,$s)){
                echo "<script>window.location='classes.php';</script>";
            }else{
                echo 'error'.mysqli_error($connect);
            }
        }
    //    update 
        if(isset($_POST['updates'])){
            $name = mysqli_real_escape_string($connect, $_POST['name']);
            $details = mysqli_real_escape_string($connect, $_POST['details']);
            $fees = mysqli_real_escape_string($connect, $_POST['price']);
            $s = "UPDATE `class` SET `className`='$name',`classDetails`= '$details',`fees`= '$fees' WHERE `id` = '".$_GET['id']."'";
            if(mysqli_query($connect,$s)){
                $sql = "UPDATE `certificate` SET `class`='$name' WHERE `class` = '".$_GET['querry']." '";
                if (mysqli_query($connect, $sql)) {
                    $a = "UPDATE `students` SET `class`= '$name' WHERE `class` = '".$_GET['querry']."' ";
                    if (mysqli_query($connect, $a)) {
                        echo "<script>window.location='classes.php';</script>";
                        echo 'success';
                    }
                }
            }else{
                echo "<script>alert('Error! Please Try again');</script>";
            }
        }
        $s="SELECT * FROM `class` WHERE `id`='".$_GET['id']."' ";
        $res=mysqli_query($connect,$s);
        $data=mysqli_fetch_assoc($res);
       ?>
 
      
    <?php include "includes/head.php";?>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
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
                            <h3>Edit <?php echo $data['className'];?></h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Class Details</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Class Informations</h4>
                        </div>
                        <form action='' method='POST' class="card-body" id="tes"  enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="basicInput">Name</label>
                                        <input type="text" name='name' class="form-control" value="<?php echo $data['className'];?>" id="basicInput"
                                            placeholder="Enter Package Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="helperText">Details</label></br>
                                        <textarea style='height:200px' class="form-control" name='details' placeholder="Enter Address" required><?php echo $data['classDetails'];?></textarea>
                                        </p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="helperText">Monthly fees</label></br>
                                        <input type="text" name='price' class="form-control" value="<?php echo $data['fees'];?>" id="basicInput"
                                            placeholder="Enter Monthly Fees" required>
                                        </p>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="update" name="updates" class='btn btn-success'>Update</button>
                                            <button id='remove' name = 'remove' class='btn btn-danger'>Remove</button>
                                            <a href="classes.php" class='btn btn-info'>Back</a>
                                            </form>

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
       <script>
                $(document).ready(function(){
                    $('#test').submit(function(e){
                        e.preventDefault();
                        $.ajax({
                            url:"includes/package1.php",
                            method:"POST",
                            type:"POST",
                            data:{
                                "customer_id":"<?php echo $data1['id'];?>",
                                "customer_name":"<?php echo $data1['customer'];?>",
                                "package_id":"<?php echo $data1['id'];?>",
                                "package_name":"<?php echo $data1['name'];?>",
                                "package_price":"<?php echo $data1['price'];?>",
                                "payment_status":"Pending",
                                "distributor_id":"14",
                                "distributor_name":"<?php echo $data1['distributor'];?>",
                               
                            },
                            success:function(data){
                                alertify.success(data);
                            }
                        })
                   

                })


       

        
        });
           
</script>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>