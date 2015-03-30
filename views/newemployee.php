<?php
session_start();

if (!$_SESSION['logged']) {
    header("Location: index.php");
    exit;
}

include '../includes/views/menu.php';
include '../includes/views/head.php';
include '../includes/views/scripts.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php head(); ?>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <?php menu(); ?>



    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        New Employee
                    </h1>


                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="protected.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-group"></i> New Employee
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <h2 >Basic Info</h2>


            <hr>


            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>First Name</label>
                        <input class="form-control" placeholder="Enter text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input class="form-control" placeholder="Enter text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Date of birth</label>
                        <input class="form-control" placeholder="dd/mm/yyyy">
                    </div>
                </div>
            </div>

            <h2>Job Info</h2>


            <hr>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Seniority</label>
                        <select class="form-control">
                            <option>Manager</option>
                            <option>Technician</option>
                            <option>Sales Associate</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Date of Hire</label>
                        <input class="form-control" placeholder="dd/mm/yyyy">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <label>Service Commission</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="exampleInputAmount" placeholder="Amount">
                      <div class="input-group-addon">%</div>
                    </div>
                </div>
            </div>


            <!-- /.row -->
            <hr>

            <div class="row">
                <div class="col-lg-12">
                    <button id="add-employee-btn" class="btn btn-success">
                        <span class="fa fa-fw fa-plus-circle" style="vertical-align:middle"></span> Add Employee
                    </button>
                    <button id="cancel-add-new-employee-btn" class="btn btn-danger">
                        <span class="fa fa-fw fa-remove" style="vertical-align:middle"></span> Cancel
                    </button>
                </div>
            </div>

            <hr>



        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php scripts() ?>
<script type="text/javascript">
    $("#nav_employees").addClass("active");
</script>

</body>

</html>
