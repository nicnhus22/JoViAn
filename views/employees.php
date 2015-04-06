<?php
session_start();

require_once '../includes/config/db.php';

if (!$_SESSION['logged'] || $_SESSION['privelege'] != "admin") {
    header("Location: ../index.php");
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


$sql = $db->prepare("SELECT * FROM Employee WHERE DOD IS NULL"); 
$sql->execute(); 
$employees = $sql->fetchAll();

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
                        <input type="text" id="search_table" class="form-control" placeholder="Search Employees...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Commission</th>
                                <th>Date of Entry</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach ($employees as $employee){
                                    echo '
                                        <tr>
                                            <td>'.$employee["ID"].'</td>
                                            <td>'.$employee["Name"].'</td>
                                            <td>'.$employee["Commission"].'</td>
                                            <td>'.$employee["DOE"].'</td>
                                            <td>
                                                <button class="btn btn-xs btn-success" onclick="route_viewEmployee('. $employee["ID"] .')">
                                                    <span class="fa fa-fw fa-eye"  style="vertical-align:middle"></span> View
                                                </button>

                                                <button onclick="deleteRow(this,'.$employee['ID'].')" class="btn btn-xs btn-danger">
                                                    <span class="fa fa-fw fa-remove" style="vertical-align:middle"></span> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    ';
                                }
                            ?>
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

    function deleteRow(button, employeeID) {
        $.ajax({

                type: "POST",
                url: "../includes/deleteEmployee.php",
                data: 'ID='+employeeID,
                cache: false,
                success: function (data) {
                    if (data == '1') {
                        button.closest('tr').remove();
                    } else {
                        console.log(data);
                    }
                }
            }); 
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('table.table').tableSearch({
            searchText:'Search Table',
            searchPlaceHolder:'Input Value'
        });
    });
</script>

</body>

</html>
