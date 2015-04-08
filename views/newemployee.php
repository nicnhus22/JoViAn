<?php
session_start();

if (!$_SESSION['logged'] || $_SESSION['privelege'] != "admin") {
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

            <form method="POST" class="form-signin" id="add_employee_form" accept-charset="UTF-8" action="">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" placeholder="Frst name" id="employee_first_name" name="employee_first_name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" placeholder="Last name" id="employee_last_name" name="employee_last_name">
                        </div>
                    </div>
                </div>
                <h2>Job Info</h2>
                <hr>
                <div class="row">
                    <div class="col-lg-4">
                        <label>Annual Pay</label>
                        <div class="form-group">
                            <div class="input-group">
                              <input type="text" class="form-control" id="employee_annual_pay" placeholder="Amount"  name="employee_annual_pay" style="  z-index: 0;">
                              <div class="input-group-addon">$</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label>Service Commission</label>
                        <div class="form-group">
                            <div class="input-group">
                              <input type="text" class="form-control" id="employee_commission" placeholder="Amount" name="employee_commission" style="z-index: 0;">
                              <div class="input-group-addon">%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Date of Hire</label>
                            <input class="form-control datepicker" type="text" placeholder="yyyy/mm/dd" id="employee_DOE" name="employee_DOE">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label>Seniority</label>
                        <select class="form-control" name="privilege" id="privilege">
                            <option value="admin">Admin</option>
                            <option value="regular">Regular</option>
                        </select>
                    </div>
                    </div>
                </div>
                <!-- /.row -->
                <hr>
                <div class="row">
                    <div class="alert alert-danger" role="alert" id="employee_add_failure" style="display:none">Oops... Something went wrong.</div>
                </div>
                <!-- Submit/Add -->
                <button class="btn btn-success" type="submit" name="submit" id="add_employee_submit">
                    <span class="fa fa-fw fa-plus-circle" style="vertical-align:middle"></span> Add Employee
                </button>
                <!-- Cancel -->
                <button id="cancel-add-new-employee-btn" class="btn btn-danger">
                    <span class="fa fa-fw fa-remove" style="vertical-align:middle"></span> Cancel
                </button>

            </form><!-- /form -->

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
