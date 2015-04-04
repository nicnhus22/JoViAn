<?php
session_start();

// Require DB access
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
    $db = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

// Fetch PCS
$PC_sql = $db->prepare("SELECT * FROM PC");
$PC_sql->execute();
$PCS = $PC_sql->fetchAll();

// Fetch Laptops
$Laptop_sql = $db->prepare("SELECT * FROM Laptop");
$Laptop_sql->execute();
$Laptops = $Laptop_sql->fetchAll();

// Fetch Part
$Part_sql = $db->prepare("SELECT * FROM Part");
$Part_sql->execute();
$Parts = $Part_sql->fetchAll();

// Fetch Software
$Software_sql = $db->prepare("SELECT * FROM Software");
$Software_sql->execute();
$Softwares = $Software_sql->fetchAll();

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

<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
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
            Inventory
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="dashboard.php">Dashboard</a>
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
    echo '<div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-success" onclick="route_newItem()">
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
            <input type="text" id="" class="form-control" placeholder="Search Inventory...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
        </div>
    </div>
    <div class="col-xs-4">
        <select class="form-control" id="inventorySort">
            <option>All</option>
            <option>PCs</option>
            <option>Laptops</option>
            <option>Parts</option>
            <option>Software</option>
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
                    <th style="width:260px;"></th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($Laptops as $Laptop) {

                    $disabled = "";

                    if ($Laptop["Quantity"] <= 0) {
                        $disabled = "disabled";
                    }

                    echo '
                                        <tr class="inventory_laptop">
                                            <td>' . $Laptop["Name"] . '</td>
                                            <td>Laptop</td>
                                            <td>' . $Laptop["Price"] . '</td>
                                            <td>' . $Laptop["Quantity"] . '</td>
                                            <td>
                                                                                            <button class="btn btn-xs btn-success">

                                                    <span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>
                                                    View
                                                </button>

                                                                                                <button class="btn btn-xs btn-info' . $disabled . '" data-toggle="modal" data-target="#serviceModal" onclick="updateServiceModal(' . $Laptop["ID"] . ',&#39Laptop&#39)">

                                                    <span class="fa fa-fw fa-usd" style="vertical-align:middle"></span> Sell
                                                </button> ';

                    if ($_SESSION["privelege"] == "admin") {
                        echo '<button class="btn btn-xs btn-warning">
                                                                <span class="fa fa-fw fa-edit" style="vertical-align:middle"></span> Edit
                                                            </button>

                                                            <button onclick="deleteRow(this)" class="btn btn-xs btn-danger">
                                                                <span class="fa fa-fw fa-remove" style="vertical-align:middle"></span> Delete
                                                            </button>';
                    }
                    echo '</td></tr>';
                }
                ?>

                <?php
                foreach ($Parts as $Part) {

                    $disabled = "";

                    if ($Laptop["Quantity"] <= 0) {
                        $disabled = "disabled";
                    }

                    echo '
                                        <tr class="inventory_part">
                                            <td>' . $Part["Name"] . '</td>
                                            <td>Part - ' . $Part["Type"] . '</td>
                                            <td>' . $Part["Price"] . '</td>
                                            <td>' . $Part["Quantity"] . '</td>
                                            <td>
<button class="btn btn-xs btn-success">                                                    <span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>
                                                    View
                                                </button>


                                                                                            <button class="btn btn-xs btn-info' . $disabled . '" data-toggle="modal" data-target="#serviceModal" onclick="updateServiceModal(' . $Part["ID"] . ',&#39Part&#39)">

                                                    <span class="fa fa-fw fa-usd" style="vertical-align:middle"></span> Sell
                                                </button> ';

                    if ($_SESSION["privelege"] == "admin") {
                        echo '<button class="btn btn-xs btn-warning">
                                                                <span class="fa fa-fw fa-edit" style="vertical-align:middle"></span> Edit
                                                            </button>

                                                            <button onclick="deleteRow(this)" class="btn btn-xs btn-danger">
                                                                <span class="fa fa-fw fa-remove" style="vertical-align:middle"></span> Delete
                                                            </button>';
                    }
                    echo '</td>
                                        </tr>';
                }
                ?>

                <?php
                foreach ($PCS as $PC) {

                    $disabled = "";

                    if ($Laptop["Quantity"] <= 0) {
                        $disabled = "disabled";
                    }

                    echo '
                                        <tr class="inventory_pc">
                                            <td>' . $PC["Name"] . '</td>
                                            <td>PC</td>
                                            <td>' . $PC["Price"] . '</td>
                                            <td>' . $PC["Quantity"] . '</td>
                                            <td>
                                                                                            <button class="btn btn-xs btn-success">

                                                    <span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>
                                                    View
                                                </button>

                                                                                            <button class="btn btn-xs btn-info' . $disabled . '" data-toggle="modal" data-target="#serviceModal" onclick="updateServiceModal(' . $PC["ID"] . ',&#39PC&#39)">

                                                    <span class="fa fa-fw fa-usd" style="vertical-align:middle"></span> Sell
                                                </button> ';

                    if ($_SESSION["privelege"] == "admin") {
                        echo '<button class="btn btn-xs btn-warning">
                                                                <span class="fa fa-fw fa-edit" style="vertical-align:middle"></span> Edit
                                                            </button>

                                                            <button onclick="deleteRow(this)" class="btn btn-xs btn-danger">
                                                                <span class="fa fa-fw fa-remove" style="vertical-align:middle"></span> Delete
                                                            </button>';
                    }
                    echo '</td>
                                        </tr>';
                }
                ?>


                <?php
                foreach ($Softwares as $Software) {

                    $disabled = "";

                    if ($Laptop["Quantity"] <= 0) {
                        $disabled = "disabled";
                    }

                    echo '
                                        <tr class="inventory_software">
                                            <td>' . $Software["Name"] . '</td>
                                            <td>Software - ' . $Software["Type"] . '</td>
                                            <td>' . $Software["Price"] . '</td>
                                            <td>' . $Software["Quantity"] . '</td>
                                            <td>
                                                                                            <button class="btn btn-xs btn-success">

                                                    <span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>
                                                    View
                                                </button>

                                                                                            <button class="btn btn-xs btn-info' . $disabled . '" data-toggle="modal" data-target="#serviceModal" onclick="updateServiceModal(' . $Software["ID"] . ',&#39Software&#39)">

                                                    <span class="fa fa-fw fa-usd" style="vertical-align:middle"></span> Sell
                                                </button> ';

                    if ($_SESSION["privelege"] == "admin") {
                        echo '<button class="btn btn-xs btn-warning">
                                                                <span class="fa fa-fw fa-edit" style="vertical-align:middle"></span> Edit
                                                            </button>

                                                            <button onclick="deleteRow(this)" class="btn btn-xs btn-danger">
                                                                <span class="fa fa-fw fa-remove" style="vertical-align:middle"></span> Delete
                                                            </button>';
                    }
                    echo '</td>
                                        </tr>';
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
    $("#nav_inventory").addClass("active");

    $('#inventorySort').change(function () {
        var selected = $('#inventorySort').val();
        if (selected == "Laptops") {
            $('.inventory_laptop').show();
            $('.inventory_pc').hide();
            $('.inventory_part').hide();
            $('.inventory_software').hide();
        }
        else if (selected == "Parts") {
            $('.inventory_part').show();
            $('.inventory_laptop').hide();
            $('.inventory_pc').hide();
            $('.inventory_software').hide();
        }
        else if (selected == "PCs") {
            $('.inventory_pc').show();
            $('.inventory_laptop').hide();
            $('.inventory_part').hide();
            $('.inventory_software').hide();
        }
        else if (selected == "Software"){
            $('.inventory_software').show();
            $('.inventory_pc').hide();
            $('.inventory_laptop').hide();
            $('.inventory_part').hide();
        }
        else if (selected == "All") {
            $('.inventory_pc').show();
            $('.inventory_part').show();
            $('.inventory_laptop').show();
            $('.inventory_software').show();
        } 

    });

</script>

</body>

</html>
