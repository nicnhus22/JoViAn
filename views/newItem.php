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
                        New Item
                    </h1>


                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="inventory.php">Inventory</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-group"></i> New Item
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <h2 >Product Information</h2>


            <hr>

            <form method="POST" class="form-signin" id="add_item" accept-charset="UTF-8" action="">
                <!-- Product Type -->
                <div class="row">
                    <div class="col-lg-4">
                        <label>Product Type</label>
                        <select class="form-control" name="item_type" id="item_type">
                            <option value="laptop">Laptop</option>
                            <option value="pc">PC</option>
                            <option value="part">Part</option>
                            <option value="software">Software</option>
                        </select>
                    </div>
                </div>

                <hr>

                <!-- Add Laptop -->
                <section id="laptop">
                    <?php require("/items/laptop.html"); ?>
                </section>

                <section id="pc">
                    <?php require("/items/pc.html"); ?>
                </section>

                <section id="part">
                    <?php require("/items/part.html"); ?>
                </section>

                <section id="software">
                    <?php require("/items/software.html"); ?>
                </section>
                
                <!-- /.row -->
                <hr>

                <div class="row">
                    <div class="alert alert-danger" role="alert" id="employee_add_failure" style="display:none">Oops... Something went wrong.</div>
                </div>
                
                <!-- Submit/Add -->
                <button class="btn btn-success" type="submit" name="submit" id="add_employee_submit">
                    <span class="fa fa-fw fa-plus-circle" style="vertical-align:middle"></span> Add Item
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
    $("#nav_inventory").addClass("active");
    
    // Initialization
    $("#laptop").show();
    $("#pc").hide();
    $("#part").hide();
    $("#software").hide();

    $("#item_type").change(function(){
        var selected = $("#item_type").val();

        if(selected == "laptop"){
            $("#laptop").show();
            $("#pc").hide();
            $("#part").hide();
            $("#software").hide();
        } else if (selected == "pc"){
            $("#pc").show();
            $("#laptop").hide();
            $("#part").hide();
            $("#software").hide();
        } else if (selected == "part"){
            $("#part").show();
            $("#laptop").hide();
            $("#pc").hide();
            $("#software").hide();
        } else if (selected == "software"){
            $("#software").show();
            $("#pc").hide();
            $("#part").hide();
            $("#laptop").hide();
        }
    });
</script>

<script type="text/javascript">
    $("#part_type").change(function(){
        var type = $("#part_type").val();
        if(type=="HD") $("span#type").html("GB");
        if(type=="RAM") $("span#type").html("GB");
        if(type=="CPU") $("span#type").html("MHz");
    });
</script>

</body>

</html>
