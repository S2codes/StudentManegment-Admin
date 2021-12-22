<?php include "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Promote Class - Student Mangement System </title>
    <?php include "includes/database.php"; ?>

    <?php include "includes/head.php"; ?>
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
                            <h3>Promote Class</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Promote Class</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <?php
                $sql = "SELECT * FROM `class`";
                $r = mysqli_query($connect, $sql);
                ?>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Class Details</h4>
                        </div>
                        <form action='class_promote.php' method='POST' class="card-body" id="class-form">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="basicInput">From Class</label>
                                        <select name="oldCls" id="" class="form-control">
                                            <option value="false">Select class</option>
                                            <?php
                                            if ($r) {
                                                if (mysqli_num_rows($r)) {
                                                    while ($cls = mysqli_fetch_assoc($r)) {
                                                        $class = $cls['className'];
                                                        echo '<option value="' . $class . '">' . $class . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">To Class</label>
                                        <select name="newCls" id="" class="form-control">
                                            <option value="false">Select class</option>
                                            <?php
                                            $sql = "SELECT * FROM `class`";
                                            $r = mysqli_query($connect, $sql);
                                            if ($r) {
                                                if (mysqli_num_rows($r)) {
                                                    while ($cls = mysqli_fetch_assoc($r)) {
                                                        $class = $cls['className'];
                                                        echo '<option value="' . $class . '">' . $class . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type='submit' name='promote' class='btn btn-success'>Promote</button>
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
<?php
if (isset($_POST['promote'])) {
    $oldClass = $_POST['oldCls'];
    $newClass = $_POST['newCls'];
    $s = "UPDATE `Students` SET `class` = '$newClass' WHERE `class` = '$oldClass'";
    $r = mysqli_query($connect, $s);
    if ($r) {
        echo "<script>alert('Successfuly Promote')</script>";
    }else{
        echo "<script>alert('Some Error Occurred, Pease try again')</script>";
    }
}
?>