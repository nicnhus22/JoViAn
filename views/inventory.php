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
                        Inventory
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="protected.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-tasks"></i> Inventory
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
                                <button class="btn btn-success">
                                    <span class="fa fa-fw fa-plus-circle" style="vertical-align:middle"></span> New Item
                                </button>
                            </div>
                         </div>';
            }

            ?>



            <hr>


            <div class="row">
                <div class="col-xs-8">
                    <div class=" form-group input-group">
                        <input type="text" class="form-control" placeholder="Search Inventory...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <iclass="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="col-xs-4">
                    <select class="form-control">
                        <option>All</option>
                        <option>Computers</option>
                        <option>Hard drives</option>
                        <option>Printers</option>
                        <option>Laptops</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>/index.html</td>
                                <td>1265</td>
                                <td>11.99</td>
                                <td>2</td>
                                <td>

                                    <button class="btn btn-xs btn-success">
                                        <span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>
                                        View
                                    </button>

                                    <button class="btn btn-xs btn-info">
                                        <span class="fa fa-fw fa-usd" style="vertical-align:middle"></span> Sell
                                    </button>




                                    <?php

                                    if ($_SESSION["privelege"] == "admin") {
                                        echo '                                            <button class="btn btn-xs btn-warning">
                                                <span class="fa fa-fw fa-edit" style="vertical-align:middle"></span> Edit
                                            </button>

                                            <button onclick="deleteRow(this)" class="btn btn-xs btn-danger">
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

    <?php scripts() ?>
    <script type="text/javascript">
        $("#nav_inventory").addClass("active");
    </script>

</body>

</html>
