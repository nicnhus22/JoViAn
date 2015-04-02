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
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

// Fetch PCS
$PC_sql = $db->prepare("SELECT * FROM pc"); 
$PC_sql->execute(); 
$PCS = $PC_sql->fetchAll();

// Fetch Laptops
$Laptop_sql = $db->prepare("SELECT * FROM laptop"); 
$Laptop_sql->execute(); 
$Laptops = $Laptop_sql->fetchAll();

// Fetch Part
$Part_sql = $db->prepare("SELECT * FROM part"); 
$Part_sql->execute(); 
$Parts = $Part_sql->fetchAll();


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
                        <input type="text" id=""class="form-control" placeholder="Search Inventory...">
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
                            
                            <?php 
                                foreach ($Laptops as $Laptop){
                                    echo '
                                        <tr class="inventory_laptop">
                                            <td>'.$Laptop["Name"].'</td>
                                            <td>Laptop</td>
                                            <td>'.$Laptop["Price"].'</td>
                                            <td>'.$Laptop["Quantity"].'</td>
                                            <td>
                                                <button class="btn btn-xs btn-success">
                                                    <span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>
                                                    View
                                                </button>

                                                <button class="btn btn-xs btn-info">
                                                    <span class="fa fa-fw fa-usd" style="vertical-align:middle"></span> Sell
                                                </button>';

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
                                foreach ($Parts as $Part){
                                    echo '
                                        <tr class="inventory_part">
                                            <td>'.$Part["Name"].'</td>
                                            <td>'.$Part["Type"].'</td>
                                            <td>'.$Part["Price"].'</td>
                                            <td>'.$Part["Quantity"].'</td>
                                            <td>
                                                <button class="btn btn-xs btn-success">
                                                    <span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>
                                                    View
                                                </button>

                                                <button class="btn btn-xs btn-info">
                                                    <span class="fa fa-fw fa-usd" style="vertical-align:middle"></span> Sell
                                                </button>';

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
                                foreach ($PCS as $PC){
                                    echo '
                                        <tr class="inventory_pc">
                                            <td>'.$PC["Name"].'</td>
                                            <td>PC</td>
                                            <td>'.$PC["Price"].'</td>
                                            <td>'.$PC["Quantity"].'</td>
                                            <td>
                                                <button class="btn btn-xs btn-success">
                                                    <span class="fa fa-fw fa-external-link" style="vertical-align:middle"></span>
                                                    View
                                                </button>

                                                <button class="btn btn-xs btn-info">
                                                    <span class="fa fa-fw fa-usd" style="vertical-align:middle"></span> Sell
                                                </button>';

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

        $('#inventorySort').change(function(){
            var selected = $('#inventorySort').val();
            if     (selected == "Laptops"){    $('.inventory_laptop').show(); $('.inventory_pc').hide(); $('.inventory_part').hide();   }
            else if(selected == "Parts"){    $('.inventory_part').show();  $('.inventory_laptop').hide(); $('.inventory_pc').hide();  }
            else if(selected == "PCs"){    $('.inventory_pc').show(); $('.inventory_laptop').hide(); $('.inventory_part').hide();  }
            else if(selected == "All"){  $('.inventory_pc').show(); $('.inventory_part').show(); $('.inventory_laptop').show(); }
        });


    </script>

</body>

</html>
