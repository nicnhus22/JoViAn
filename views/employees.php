<?php
session_start();

if (!$_SESSION['logged'] || $_SESSION['privelege'] != "admin") {
    header("Location: ../index.php");
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
                        Employees
                    </h1>


                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="protected.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-group"></i> Employees
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <button id="new-employee-btn" onclick="route_newEmployee()" class="btn btn-success">
                        <span class="fa fa-fw fa-plus-circle" style="vertical-align:middle"></span> New Employee
                    </button>
                </div>
            </div>


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
                                    <button class="btn btn-xs btn-success" onclick="route_viewEmployee(1)">
                                        <span class="fa fa-fw fa-eye"  style="vertical-align:middle"></span> View
                                    </button>

                                    <button class="btn btn-xs btn-warning">
                                        <span class="fa fa-fw fa-edit" style="vertical-align:middle"></span> Edit
                                    </button>

                                    <button onclick="deleteRow(this)" class="btn btn-xs btn-danger">
                                        <span class="fa fa-fw fa-remove" style="vertical-align:middle"></span> Delete
                                    </button>

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


<?php scripts() ?>
<script type="text/javascript">
    $("#nav_employees").addClass("active");
</script>

</body>

</html>
