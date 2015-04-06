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

$sql = $db->prepare("SELECT (SELECT SUM(ServiceCost) FROM (SELECT ServiceCost, EmployeeID FROM Install UNION SELECT ServiceCost, EmployeeID FROM Repair UNION SELECT ServiceCost, EmployeeID FROM Upgrade) AS NewTable WHERE NewTable.EmployeeID = ?) as sum");
$sql->bindValue(1, $ID);
$sql->execute();
$commission = $sql->fetch(PDO::FETCH_ASSOC);

$commissionToDate = number_format($commission["sum"] * ($row["Commission"]/100), 2, '.', '');

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

    <div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
                    <h4 class="modal-title" id="activity_title"></h4>
                </div>
                <div class="modal-body col-lg-12">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


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
                        <li class="list-group-item">Commision To Date:<b> <?= $commissionToDate ?> $</b></li>
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

        var d = new Date();


        $('#endDate').attr("placeholder", d.getFullYear() + '-' +
            ((d.getMonth()+1) < 10 ? '0' : '') + (d.getMonth()+1) + '-' +
            (d.getDay() < 10 ? '0' : '') + d.getDay());

    });


    $("#nav_employees").addClass("active");
</script>

</body>

</html>
