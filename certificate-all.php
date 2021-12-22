 <?php include "auth.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Certificate - Student Mangement System </title>
    <?php include "includes/database.php";?>
    <?php include "includes/head.php";?>
    <style>
        a{
            color:#333;
        }
    </style>
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
                            <h3>All Certificate</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Certificate</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Class
                            <select name="class" id="certclass" class="form-control mt-2">
                                <option value="false" selected>Select The Class</option>
                                <?php include "includes/classdrop.php"; ?>
                            </select>
                        </div>
                        <div class="card-body">

                            <table class="table table-striped" id="certTable">
                            
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Student Name</th>
                                        <th>Class</th>
                                        <th>Roll No</th>
                                        <th>Certificate</th>
                                        <th>Status</th>
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <tbody id="certinfo">
                                
                                    <?php
                                    $sno = 1; 
                                        $s="SELECT * FROM `certificate` ORDER BY `certificate`.`roll` ASC";
                                        $res=mysqli_query($connect,$s);
                                        while($data=mysqli_fetch_array($res)){
                                            $edit="<span class='btn btn-primary'>Edit</span>";

                                            $check = $data['status'];
                                            if($check == 1){
                                                $action="<button class = 'btn btn-info px-3' type = 'button'> Active </button>";
                                            }else if($check == 0){
                                                $action="<button class = 'btn btn-warning' type = 'button'>Disable</button>";
                                            }
                                            echo "
                                            <tr>
                                            <td>".$sno."</td>
                                            <td>".$data['student']."</a></td>
                                            <td>".$data['class']."</a></td>
                                            <td>".$data['roll']."</a></td>
                                            <td>".$data['certificateName']."</a></td>
                                            <td>".$action."</td>
                                            <td><a href='certificate_edit.php?query_roll=".$data['roll']."&class=".$data['class']."'>".$edit."</a></td>
                                            </tr>
                                            ";
                                            $sno += 1;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>

            <?php include "includes/footer.php";?>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('certTable');
        let dataTable = new simpleDatatables.DataTable(certTable);
    </script>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/filter/allcertificate.js"></script>
</body>

</html>
