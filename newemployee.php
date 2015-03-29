<?php
session_start();

if (!$_SESSION['logged']) {
    header("Location: index.php");
    exit;
}

include 'includes/menu.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>New Employee</title>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="assets/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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

<!-- jQuery -->
<script src="assets/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="assets/js/plugins/morris/raphael.min.js"></script>
<script src="assets/js/plugins/morris/morris.min.js"></script>
<script src="assets/js/plugins/morris/morris-data.js"></script>


<!-- JavaScript -->
<script src="assets/js/script.js"></script>

</body>

</html>
