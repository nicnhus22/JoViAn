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

$ProductID = $_GET["id"];
$ProductType = $_GET["type"];

try {
    //Connect to the databasse
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

if($ProductType == "laptop"){
    $sql = $db->prepare("SELECT * FROM Laptop WHERE ID=? LIMIT 1"); 
    $sql->bindValue(1, $ProductID);
    $sql->execute(); 
    $product = $sql->fetch(PDO::FETCH_ASSOC);
} else if ($ProductType == "pc"){
    $sql = $db->prepare("SELECT * FROM PC WHERE ID=? LIMIT 1"); 
    $sql->bindValue(1, $ProductID);
    $sql->execute(); 
    $product = $sql->fetch(PDO::FETCH_ASSOC);
} else if ($ProductType == "part"){
    $sql = $db->prepare("SELECT * FROM Part WHERE ID=? LIMIT 1"); 
    $sql->bindValue(1, $ProductID);
    $sql->execute(); 
    $product = $sql->fetch(PDO::FETCH_ASSOC);
} else if ($ProductType == "software"){
    $sql = $db->prepare("SELECT * FROM Software WHERE ID=? LIMIT 1"); 
    $sql->bindValue(1, $ProductID);
    $sql->execute(); 
    $product = $sql->fetch(PDO::FETCH_ASSOC);
}
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
                        Edit Item <?php echo $ProductID?>
                    </h1>

                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="inventory.php">Inventory</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-group"></i> Edit Item
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
                <section id="laptop" style="display:none">
                    <?php require("../views/items/laptop.html"); ?>
                </section>

                <section id="pc" style="display:none">
                    <?php require("../views/items/pc.html"); ?>
                </section>

                <section id="part" style="display:none">
                    <?php require("../views/items/part.html"); ?>
                </section>

                <section id="software" style="display:none">
                    <?php require("../views/items/software.html"); ?>
                </section>
                
                <!-- /.row -->
                <hr>

                <div class="row">
                    <div class="alert alert-danger" role="alert" id="employee_add_failure" style="display:none">Oops... Something went wrong.</div>
                </div>
                
                <!-- Submit/Add -->
                <button class="btn btn-success" type="submit" name="submit" id="edit_item_submit">
                    <span class="fa fa-fw fa-plus-circle" style="vertical-align:middle"></span> Edit Item
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
    var type = <?php echo(json_encode($ProductType)) ?>;
    init(type);
    console.log(type);
    function init(type){
        $("#"+type).show();
        $("#item_type").prop('disabled', true);
        $('#item_type').val(type);

        switch(type){
            case 'laptop':
                var laptop = <?php echo(json_encode($product))?>;
                $("#laptop_name").val(laptop.Name);
                $("#laptop_cpu").val(laptop.CPU);
                $("#laptop_ram").val(laptop.RAM);
                $("#laptop_hd").val(laptop.HD);
                $("#laptop_screen").val(laptop.Screen);
                $("#laptop_price").val(laptop.Price);
                $("#laptop_quantity").val(laptop.Quantity);
                break;
            case 'pc':
                var pc = <?php echo(json_encode($product))?>;
                $("#pc_name").val(pc.Name);
                $("#pc_cpu").val(pc.CPU);
                $("#pc_ram").val(pc.RAM);
                $("#pc_hd").val(pc.HD);
                $("#pc_price").val(pc.Price);
                $("#pc_quantity").val(pc.Quantity);
                break;
            case 'part':
                var part = <?php echo(json_encode($product))?>;
                $("#part_name").val(part.Name);
                $("#part_type").val(part.Type);
                $("#part_value").val(part.Value);
                $("#part_price").val(part.Price);
                $("#part_quantity").val(part.Quantity);
                break;
            case 'software':
                var software = <?php echo(json_encode($product))?>;
                $("#software_name").val(software.Name);
                $("#software_type").val(software.Type);
                $("#software_size").val(software.Size);
                $("#software_price").val(software.Price);
                $("#software_quantity").val(software.Quantity);
                break;
        }

    }
</script>
<script type="text/javascript">
    $("#nav_inventory").addClass("active");
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
