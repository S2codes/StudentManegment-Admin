<?php include "auth.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard - Perfect BoardBand</title>
    <?php include "includes/head.php";?>
</head>

<body>
    <div id="app">
        <?php include "includes/sidebar.php";?>
        <?php
            include "includes/database.php";
            //getting status
            $c="SELECT * FROM `class` ";
            $cus=mysqli_query($connect,$c);
            $cus_count=mysqli_num_rows($cus);

            //count recharges
            $r="SELECT * FROM `students`";
            $rc=mysqli_query($connect,$r);
            $student_count=mysqli_num_rows($rc);

 
        ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Profile Statistics</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12" >
                        <div class="row">
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Class</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $cus_count;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Student</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $student_count;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body py-4 px-6">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-xl">
                                                <img src="assets/images/faces/1.jpg" alt="Face 1">
                                            </div>
                                            <div class="ms-2 name">
                                                <h5 class="font-bold">Admin</h5>
                                                <h6 class="text-muted mb-0">admmin@info.com</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                        </div>
                            
                        </div>


                       
                </section>

                <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>All Class</h4>
                                    </div>
                                    <div class="card-body">
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Class</th>
                                                <th>Monthly Fees</th>
                                                <th>Total Student</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        <?php
                                            $sno = 1;
                                            $Tstudent= 0;
                                            $s="SELECT * FROM `class`";
                                            $res=mysqli_query($connect,$s);
                                            while($data=mysqli_fetch_assoc($res)){
                                                $class = $data["className"];
                                                $sql = "SELECT * FROM `students` WHERE class = '$class'";                                                
                                                $r = mysqli_query($connect, $sql);
                                                if (mysqli_num_rows($r) > 0) {
                                                    $Tstudent = mysqli_num_rows($r);
                                                }
                                                echo "
                                                <tr>
                                                    <td>".$sno."</td>
                                                    <td>".$class."</td>
                                                    <td>".$data['fees']."</td>
                                                    <td>".$Tstudent."</td>
                                                    <td><a href='students.php' class='btn btn-info'>View </a></td>
                                                </tr>
                                                ";
                                                $sno +=1;
                                                $Tstudent = 0;
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                   
                        <!-- <div class="card">
                            <div class="card-header">
                                <h4>Visitors Profile</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitors-profile"></div>
                            </div>
                        </div> -->
                    </div>




            </div>

            <?php include "includes/footer.php";?>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>