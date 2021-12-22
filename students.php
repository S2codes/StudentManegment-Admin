<?php include "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student - Perfect</title>
    <?php include "includes/database.php"; ?>
    <?php include "includes/head.php"; ?>
    <style>
        a {
            color: #333;
        }
    </style>
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
                            <h3>Student</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Student</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Student data
                            <div class="container my-2">
                                <select name="" id="clasdrop" class="form-control">
                                    <option value="selectclass" selected>Select the Class</option>
                                    <!-- <option value="1">Class 1</option>
                                <option value="2">Class 2</option>
                                <option value="3">Class 3</option> -->
                                    <?php include "includes/classdrop.php"; ?>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Name</th>
                                        <th>Parents</th>
                                        <th>Class</th>
                                        <th>Roll</th>
                                        <th>Operation</th>

                                    </tr>
                                </thead>
                                <tbody id="studentInfo">
                                    
                                    <?php
                                    // $s = "SELECT * FROM `customers` ORDER BY `id` DESC ";
                                    $sql = "SELECT * FROM `students` ";
                                    $res = mysqli_query($connect, $sql);
                                    $sn = 1;
                                    while ($data = mysqli_fetch_array($res)) {
                                        $edit = "<span class='btn btn-primary'>Info</span>";
                                        
                                        echo "
                                            <tr>
                                                <td><a href='studentinfo.php?id=" . $data['id'] . "'>" .$sn. "</a></td>
                                                <td><a href='studentinfo.php?id=" . $data['id'] . "'>" . $data['name'] . "</a></td>
                                                <td><a href='studentinfo.php?id=" . $data['id'] . "'>" . $data['parents'] . "</a></td>
                                                <td><a href='studentinfo.php?id=" . $data['id'] . "'>" . $data['class'] . "</a></td>
                                                <td><a href='studentinfo.php?id=" . $data['id'] . "'>" . $data['roll'] . "</a></td>
                                               
                                                <td><a href='studentinfo.php?id=" . $data['id'] . "'>" . $edit . "</a></td>
                                            </tr>
                                            ";
                                            $sn += 1;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>

            <div class="modal popup" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-body text-center">

                                <span aria-hidden="true">&times;</span>
                                <img src='' style='height:400px;width:auto;' id='modal_image' />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "includes/footer.php";
            echo '</div>
     </div>';
            ?>
            <script>
                $(document).ready(function() {
                    $('.show_popup').click(function() {
                        src_val = $(this).attr('src');
                        $('#modal_image').attr('src', src_val);
                        $('.popup').modal('show');


                    })



                });
            </script>


            <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js">
            </script>
            <script src="assets/js/bootstrap.bundle.min.js"></script>

            <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
            <script>
                let table = document.querySelector('#table');
                let dataTable = new simpleDatatables.DataTable(table1);
            </script>

            <script src="assets/js/main.js"></script>
            <script src="assets/js/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#clasdrop').on('change', () => {
                        var dropVal = $('#clasdrop').val();
                        if (dropVal != 'selectclass') {
                            fetch_data(dropVal);
                        }
                    });

                    function fetch_data(dataVal) {
                        $.ajax({
                            url: 'operation/fetch-allstudent.php',
                            data: {'class': dataVal, 'api' : 'ss123' },
                            type: 'post',
                            dataType : 'JSON',

                            success: function(data, status) {
                                if (status) {
                                    console.log(data);
                                    $('#studentInfo').html('');
                                    $.each(data, function (key, val) {
                                        if (val.Name == false) {
                                            $('#studentInfo').append(`<tr> <td></td>  <td></td> <td>No</td> <td>Record</td> <td>Found</td> <td></td></tr>`);
                                        }else{
                                            $('#studentInfo').append(` <tr>
                                                    <td><a href='studentinfo.php?id=${val.Id}'>${val.Sno}</a></td>
                                                    <td><a href='studentinfo.php?id=${val.Id}'>${val.Name}</a></td>
                                                    <td><a href='studentinfo.php?id=${val.Id}'>${val.Parents}</a></td>
                                                    <td><a href='studentinfo.php?id=${val.Id}'>${val.Class}</a></td>
                                                    <td><a href='studentinfo.php?id=${val.Id}'>${val.Roll}</a></td>
                                                     <td><a href='studentinfo.php?id=${val.Id}' class='btn btn-primary'>Info</a></td>
                                                 </tr>`);
                                        }


                                    });

                                }
                            }
                        });
                    }

                });
            </script>
</body>

</html>