<?php
session_start();

if(!$_SESSION['logged']){
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

    <title>Employees</title>

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
                            Employees
                        </h1>



                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="protected.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-group"></i> Employees
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <?php

                if ($_SESSION["privelege"] == "admin") {
                    echo '
                        <div class="row">
                            <div class="col-lg-12">
                                <button id="new-employee-btn" class="btn btn-success">
                                    <span class="fa fa-fw fa-plus-circle" style="vertical-align:middle"></span> New Employee
                                </button>
                            </div>
                         </div>';
                }

                ?>



                <hr>


                <div class="row">
                    <div class="col-xs-8">
                        <div class=" form-group input-group">
                            <input type="text" class="form-control" value="Search Employees...">
                            <span class="input-group-btn"><button class="btn btn-default" type="button"><i
                                        class="fa fa-search"></i></button></span>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <select class="form-control">
                            <option>All</option>
                            <option>Managers</option>
                            <option>Technicians</option>
                            <option>Sales Associates</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Seniority</th>
                                    <th>$ Sales</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Andrew</td>
                                    <td>Costa</td>
                                    <td>Store Manager</td>
                                    <td>39 000</td>
                                    <td>

                                        <button class="btn btn-xs btn-success">
                                            <span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>
                                            View
                                        </button>




                                        <?php

                                        if ($_SESSION["privelege"] == "admin") {
                                            echo '                                            <button class="btn btn-xs btn-warning">
                                                <span class="fa fa-fw fa-edit" style="vertical-align:middle"></span> Edit
                                            </button>

                                            <button class="btn btn-xs btn-danger">
                                                <span class="fa fa-fw fa-remove" style="vertical-align:middle"></span> Delete
                                            </button>';
                                        }

                                        ?>

                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- /.row -->


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
