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

$nameArray =  explode(" ", $row["Name"]);

$firstName = $nameArray[0];
$lastName = $nameArray[1];

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


            <form method="POST" class="form-signin" id="edit_employee_form" accept-charset="UTF-8" action="">
            <div class="row">
                <div class="col-sm-4">
                    <img class="img-responsive" src="../assets/img/andrew.jpg">
                </div>
                <div class="col-sm-4">



                        <fieldset disabled="">
                            <div class="form-group">
                                <label for="disabledSelect">Employee ID</label>
                                <input class="form-control" id="empID" type="text" value="<?= $row["ID"]?>" disabled="">
                            </div>
                        </fieldset>

                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" value="<?= $firstName ?>" id="firstName" name="firstName">
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" value="<?= $lastName ?>" id="lastName" name="lastName">
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>
                            <input class="form-control" value="<?= $row["email"] ?>" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label>User Name</label>
                            <input class="form-control" value="<?= $row["username"] ?>" id="username" name="username">
                        </div>


                </div>

                <div class="col-sm-4">

                    <div class="form-group">
                        <label>Seniority</label>
                        <select class="form-control" name="privilege" id="privilege">
                            <option value="admin" <?php if ($row["privelege"] == "admin") echo "selected"; else echo "";?>>Admin</option>
                            <option value="regular" <?php if ($row["privelege"] == "regular") echo "selected"; else echo "";?>>Regular</option>
                        </select>
                    </div>

                    <fieldset disabled="">
                        <div class="form-group">
                            <label for="disabledSelect">Date of Hire</label>
                            <input class="form-control" id="disabledInput2" type="text" placeholder="<?= $row["DOE"]?>" disabled="">
                        </div>
                    </fieldset>



                        <div class="form-group">
                            <label>Service Commission</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="commission" value="<?= $row["Commission"]?>" name="commission" style="  z-index: 0;">
                                <div class="input-group-addon">%</div>
                            </div>
                        </div>

                    <div class="form-group">
                        <label>Annual Salary</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="annualPay" value="<?= $row["AnnualPay"]?>" name="annualPay" style="  z-index: 0;">
                            <div class="input-group-addon">$</div>
                        </div>
                    </div>

                    <fieldset disabled="">
                        <div class="form-group">
                            <label for="disabledSelect">Commission To Date</label>
                            <input class="form-control" id="disabledInput3" type="text" placeholder="<?= $commissionToDate?>" disabled="">
                        </div>
                    </fieldset>

                    <button class="col-sm-offset-6 btn btn-warning col-sm-6" type="submit" name="submit" id="editEmployeeSubmit">
                        <span class="fa fa-fw fa-save" style="vertical-align:middle"></span> Save Changes
                    </button>
                </div>
            </div>

            </form>

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
