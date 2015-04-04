<?php
session_start();

require_once '../includes/config/db.php';

if (!$_SESSION['logged']) {
    header("Location: index.php");
    exit;
}

include '../includes/views/menu.php';
include '../includes/views/head.php';
include '../includes/views/scripts.php';

try {
    //Connect to the databasse
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$ID = intval($_GET["ID"]);

# OLD: $sql = $db->prepare("SELECT * FROM Employee, users WHERE users.EmployeeID = ? AND users.EmployeeID = Employee.ID");
$sql = $db->prepare("SELECT * FROM Employee, users WHERE users.EmployeeID = ? AND users.EmployeeID = Employee.ID");
$sql->bindValue(1, $ID);
$sql->execute();
$row = $sql->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php head(); ?>
    <title>View Employee | <?php echo $row["Name"]; ?></title>
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
                            <i class="fa fa-dashboard"></i> <a href="employees.php">Employees</a>
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
                        <?php echo $row["Name"]; ?>
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
                        <li class="list-group-item">Employee ID: <span id="empID"><?= $row["ID"]?></span></li>
                        <li class="list-group-item">Name: <?= $row["Name"]?> </li>
                        <li class="list-group-item">Email: <?= $row["email"]?> </li>
                        <li class="list-group-item">Username: <?= $row["username"]?> </li>
                    </ul>
                </div>

                <div class="col-sm-4">
                    <ul class="list-group">
                        <li class="list-group-item">Seniority: <?= $row["privelege"]?> </li>
                        <li class="list-group-item">Date of Hire: <?= $row["DOE"]?></li>
                        <li class="list-group-item">Service Commission: <?= $row["Commission"]?> %</li>
                        <li class="list-group-item">Yearly Salary: <?= $row["AnnualPay"]?> $</li>
                    </ul>
                </div>
            </div>

            <h2>Activity History</h2>

            <hr>

            <div class="row">

                <div class="col-lg-2">
                    <div class="form-group">
                        <input id="beginDate" class="datepicker form-control" type="text" placeholder="1990-01-01">
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="form-group">
                        <input id="endDate" class="datepicker form-control" type"text"  placeholder="2015-01-01">
                    </div>
                </div>

                <div class="col-lg-2">
                    <button id="goActivity" class="btn btn-sm btn-success">
                        <span class="fa fa-fw fa-arrow-right" style="vertical-align:middle"></span>
                        Go
                    </button>
                </div>

            </div>

            <ul class="nav nav-tabs">
                <li role="presentation" class="tab active"><a class="activityTab" id="Sale" href="#Sales">Sales</a></li>
                <li role="presentation"><a class="activityTab" id="OnlineSale" href="#OnlineSales">Online Sales</a></li>
                <li role="presentation"><a class="activityTab" id="Repair" href="#Repairs" href="#">Repairs</a></li>
                <li role="presentation"><a class="activityTab" id="Upgrade" href="#Upgrades">Upgrades</a></li>
                <li role="presentation"><a class="activityTab" id="Install" href="#Installs">Installs</a></li>
            </ul>

            <div class="row">
                <div class="col-lg-12">

                    <div class="table-responsive">
                        <table id="activityTable" class="table table-bordered table-hover" style="border: 0px;">
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

    $(document).ready(function(){

        renderTable("Sale");

    });


    $("#nav_employees").addClass("active");
</script>

</body>

</html>
