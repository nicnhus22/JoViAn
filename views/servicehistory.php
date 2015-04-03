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
        <title>Service History</title>
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
                        Service History
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="protected.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-history"></i> Service History
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <hr>


            <div class="row">
                <div class="col-xs-6">
                    <div class=" form-group input-group">
                        <input type="text" class="form-control" value="Search Orders...">
                            <span class="input-group-btn"><button class="btn btn-default" type="button"><i
                                        class="fa fa-search"></i></button></span>
                    </div>
                </div>
                <div class="col-xs-4">
                    <select class="form-control">
                        <option>All</option>
                        <option>Open</option>
                        <option>Completed</option>
                    </select>
                </div>

                <div class="col-lg-2">
                    <div class="form-group">
                        <input class="datepicker form-control" type="text" placeholder="dd/mm/yyyy">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Description</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>/index.html</td>
                                <td>1265</td>
                                <td>11.99</td>
                                <td>Opened</td>
                                <td>

                                    <button class="btn btn-xs btn-success">
                                        <span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>
                                        View
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
        $("#nav_orders").addClass("active");
    </script>
</body>

</html>
