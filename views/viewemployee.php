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
    <title>View Employee | <?php echo $_SESSION["username"] ?></title>
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
                        View Employee
                    </h1>


                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-group"></i> View Employee
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-lg-4">
                    <h2>
                        <?php echo $_SESSION["username"] ?>
                    </h2>
                </div>
                <div class="col-lg-4">
                    <h2>Basic Info</h2>
                </div>

                <div class="col-lg-4">
                    <h2>Job Info</h2>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-sm-4">
                    <img class="img-responsive" src="../assets/img/andrew.jpg">
                </div>
                <div class="col-sm-4">
                    <ul class="list-group">
                        <li class="list-group-item">First Name</li>
                        <li class="list-group-item">Last Name</li>
                        <li class="list-group-item">Date of birth</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>

                <div class="col-sm-4">
                    <ul class="list-group">
                        <li class="list-group-item">Seniority</li>
                        <li class="list-group-item">Date of Hire</li>
                        <li class="list-group-item">Service Commission</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
            </div>

            <h2>Order History</h2>

            <hr>

            <div class="row">

                <div class="col-lg-2">
                    <div class="form-group">
                        <input class="datepicker form-control" type="text" placeholder="dd/mm/yyyy">
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="form-group">
                        <input class="datepicker form-control" type"text"  placeholder="dd/mm/yyyy">
                    </div>
                </div>

                <div class="col-lg-2">
                    <button class="btn btn-sm btn-success">
                        <span class="fa fa-fw fa-arrow-right" style="vertical-align:middle"></span>
                        Go
                    </button>
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

                                    <button class="btn btn-xs btn-info">
                                        <span class="fa fa-fw fa-truck" style="vertical-align:middle"></span> Process
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
