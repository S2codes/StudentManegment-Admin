<?php include "auth.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>All class - Student Mangement System</title>
    <?php include "includes/head.php";
        include "includes/database.php";
    ?>
    <style>
    .material-icons {
        float: left;
    }
    </style>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                            <h3>All Classes</h3>
                            <p class="text-subtitle text-muted">All class details are listed here</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Classes</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Class Name</th>
                                <th>Class Details</th>
                                <th>Monthly Fees</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                        $s="SELECT * FROM `class` ORDER BY `class`.`id` ASC";
                                        $res=mysqli_query($connect,$s);
                                        while($data=mysqli_fetch_array($res)){
                                            $id =$data['id'];
                                            echo "
                                            <tr>
                                                <td><a href='#'>".$data['className']."</a></td>
                                                <td><a href='#'>".$data['classDetails']."</a></td>
                                                <td><a href='#'>&#8377; ".$data['fees']."</a></td>
                                                <td><a href='class.php?id=$id&querry=".$data['className']."' class= 'btn btn-info'>Edit</a></td>
                                            </tr>
                                            ";
                                        }
                                        // package.php?id=".$data['id']."
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

    <script src="assets/js/main.js"></script>
</body>

</html>