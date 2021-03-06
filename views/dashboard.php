<?php 
    session_start(); 

    // Require DB access
   require_once '../includes/config/db.php';

    if(!$_SESSION['logged']){ 
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

    // Fetch Inventory Count
    $sql = $db->prepare("SELECT (SELECT COUNT(ID) FROM Laptop) 
                              + (SELECT COUNT(ID) FROM PC) 
                              + (SELECT COUNT(ID) FROM Software) 
                              + (SELECT COUNT(ID) FROM Part) as count");
    $sql->execute();
    $inventorySize = $sql->fetch(PDO::FETCH_ASSOC);

    // Fetch Employee Count
    $sql = $db->prepare("SELECT COUNT(*) AS count FROM Employee WHERE DOD IS NULL");
    $sql->execute();
    $employeeSize = $sql->fetch(PDO::FETCH_ASSOC);

    // Fetch Transaction Count
    $sql = $db->prepare("SELECT (SELECT COUNT(*) FROM Install) 
                              + (SELECT COUNT(*) FROM OnlineSale) 
                              + (SELECT COUNT(*) FROM Sale) 
                              + (SELECT COUNT(*) FROM Repair)
                              + (SELECT COUNT(*) FROM Upgrade) as count");
    $sql->execute();
    $transactionSize = $sql->fetch(PDO::FETCH_ASSOC);

    # Fetch total revenue
    $sql = $db->prepare("SELECT (SELECT SUM(Price) FROM (SELECT ID, Price FROM Laptop UNION SELECT ID, Price FROM PC UNION SELECT ID, Price FROM Part UNION SELECT ID, Price FROM Software) AS NewTable, Sale WHERE NewTable.ID = Sale.ProductID) +
                        (SELECT SUM(Price) FROM (SELECT ID, Price FROM Laptop UNION SELECT ID, Price FROM PC UNION SELECT ID, Price FROM Part UNION SELECT ID, Price FROM Software) AS NewTable, OnlineSale WHERE NewTable.ID = OnlineSale.ProductID) +
                        (SELECT SUM(ServiceCost) FROM (SELECT ServiceCost FROM Install UNION SELECT ServiceCost FROM Repair UNION SELECT ServiceCost FROM Upgrade) AS NewTable) AS sum ");
    $sql->execute();
    $revenue = $sql->fetch(PDO::FETCH_ASSOC);

    $sql = $db->prepare("SELECT SUM(Price) AS Total FROM (SELECT ID, Price FROM Laptop UNION SELECT ID, Price FROM PC UNION SELECT ID, Price FROM Part UNION SELECT ID, Price FROM Software) AS NewTable, OnlineSale WHERE NewTable.ID = OnlineSale.ProductID;");
    $sql->execute();
    $onlineRevenue = $sql->fetch(PDO::FETCH_ASSOC);

    # Fetch online sales
    $sql = $db->prepare("SELECT * FROM OnlineSale LIMIT 5");
    $sql->execute();
    $onlineSales = $sql->fetchAll();


    # Fetch best employees
    $sql = $db->prepare("SELECT Name,SaleCount,ID FROM (SELECT EmployeeID, COUNT(*) AS SaleCount FROM Sale GROUP BY EmployeeID ORDER BY SaleCount DESC LIMIT 5) AS BestEmployee, Employee WHERE BestEmployee.EmployeeID = Employee.ID");
    $sql->execute();
    $bestEmployees = $sql->fetchAll();


    # Fetch best employees
    $sql = $db->prepare("SELECT * FROM Sale ORDER BY Date ASC");
    $sql->execute();
    $sales = $sql->fetchAll();

    # Fetch best employees
    $sql = $db->prepare("SELECT * FROM OnlineSale ORDER BY Date ASC");
    $sql->execute();
    $onlinesales = $sql->fetchAll();

    # Fetch oldest employees 
    $sql = $db->prepare("SELECT Name,SaleCount,ID,DOE FROM (SELECT EmployeeID, COUNT(*) AS SaleCount FROM Sale GROUP BY EmployeeID ORDER BY SaleCount DESC LIMIT 5) AS BestEmployee, Employee WHERE BestEmployee.EmployeeID = Employee.ID ORDER BY DOE");
    $sql->execute();
    $seniors = $sql->fetchAll();

    # Get store names for bar chart
    $sql = $db->prepare("SELECT DISTINCT StoreName FROM OnlineSale");
    $sql->execute();
    $stores = $sql->fetchAll();

    # Get distict dates for bar graph
    $sql = $db->prepare("SELECT DISTINCT YEAR(Date) FROM OnlineSale ORDER BY YEAR(Date)");
    $sql->execute();
    $years = $sql->fetchAll();

    # Get online store data for bar graph
    $sql = $db->prepare("SELECT StoreName, YEAR(Date), COUNT(YEAR(Date)) FROM OnlineSale GROUP BY StoreName, YEAR(Date)");
    $sql->execute();
    $quantityPerOnlineStore = $sql->fetchAll();



?>

<!DOCTYPE html>
<html>
    <head>
        <?php head(); ?>

        <style type="text/css">
            #map-canvas { height: 400px; width: 100%; margin: 0; padding: 0;}
        </style>


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
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-cubes fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $inventorySize["count"] ?></div>
                                        <div>Products</div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                if ($_SESSION["privelege"] == 'admin') {
                                    echo '<a href="inventory.php">
                                                <div class="panel-footer">
                                                    <span class="pull-left">View Inventory</span>
                                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>';
                                } 
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $employeeSize["count"] ?></div>
                                        <div>Employees</div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                if ($_SESSION["privelege"] == 'admin') {
                                    echo '<a href="employees.php">
                                                <div class="panel-footer">
                                                    <span class="pull-left">View Employees</span>
                                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>';
                                } 
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $transactionSize["count"] ?></div>
                                        <div>Transactions</div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                if ($_SESSION["privelege"] == 'admin') {
                                    echo '<a href="orders.php">
                                                <div class="panel-footer">
                                                    <span class="pull-left">View Transactions</span>
                                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>';
                                } 
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-right">
                                        <div class="huge"><?php echo number_format($revenue["sum"], 2,".", " ") ?><i class="fa fa-dollar"></i></div>
                                        <div>in total revenue</div>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div class="huge"><?php echo number_format($onlineRevenue["Total"], 2, '.', ' ') ?><i class="fa fa-dollar"></i></div>
                                        <div>through online sale</div>
                                    </div>
                                    <div class="col-xs-12 text-right">
                                        <div class="huge"><?php echo number_format($revenue["sum"]-$onlineRevenue["Total"], 2, '.', ' ') ?><i class="fa fa-dollar"></i></div>
                                        <div>through store services</div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                if ($_SESSION["privelege"] == 'admin') {
                                    echo '<a href="orders.php">
                                            <div class="panel-footer">
                                                <span class="pull-left">View Orders</span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>';
                                } 
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Online &amp; Regular Sales </h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-line-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-desktop fa-fw"></i> Online Store Comparison </h3>
                            </div>
                            <div class="panel-body">
                                <div id="bar-example"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-user"></i> Seniority Table - Our Oldest Employees</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Date of Entry</th>
                                                <th>Number Of Sales</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach($seniors as $senior){
                                                    if ($_SESSION["privelege"] == 'admin') {
                                                        echo '<tr><td><a href="viewemployee.php?ID='.$senior["ID"].'">'.$senior["Name"].'</a></td><td>'.$senior["DOE"].'</td><td>'.$senior["SaleCount"].'</td></tr>';
                                                    }else{
                                                        echo '<tr><td>'.$senior["Name"].'</td><td>'.$senior["DOE"].'</td><td>'.$senior["SaleCount"].'</td></tr>';
                                                    }
                                                }

                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-credit-card"></i> Latest Online Sales by Date</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Store Name</th>
                                                <th>Date</th>
                                                <th>Client Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach($onlineSales as $onlineSale){
                                                    echo '<tr><td>'.$onlineSale["StoreName"].'</td><td>'.$onlineSale["Date"].'</td><td>'.$onlineSale["CName"].'</td></tr>';
                                                }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="orders.php">View All Online Sales <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Our 5 Top Employees</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <?php 
                                        $counter = 1;
                                        foreach($bestEmployees as $bestEmployee){
                                            if ($_SESSION["privelege"] == 'admin') {
                                                echo '<a href="viewemployee.php?ID='.$bestEmployee["ID"].'" class="list-group-item">
                                                    '.$counter.'. <i class="fa fa-fw fa-user"></i> '.$bestEmployee["Name"].' made '.$bestEmployee["SaleCount"].' ';
                                                echo ($bestEmployee["SaleCount"] > 1 ? 'sales this week </a>' : 'sale this week </a>');
                                            }else {
                                                echo '<a href="" class="list-group-item">
                                                    '.$counter.'. <i class="fa fa-fw fa-user"></i> '.$bestEmployee["Name"].' made '.$bestEmployee["SaleCount"].' ';
                                                echo ($bestEmployee["SaleCount"] > 1 ? 'sales this week </a>' : 'sale this week </a>');
                                            }
                                            
                                            $counter++;
                                        }
                                    ?>
                                    
                                </div>
                                <?php 
                                    if ($_SESSION["privelege"] == 'admin') {
                                        echo '<div class="text-right">
                                                <a href="employees.php">View All Employees <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>';
                                    } 
                                ?>
                            </div>
                        </div>
                    </div>



                </div>
                <!-- /.row -->



                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-truck fa-fw"></i> Latest Shipments</h3>
                    </div>
                    <div class="panel-body" style="padding: 0;">
                        <div id="map-canvas"></div>
                    </div>
                </div>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->



    </div>
    <!-- /#wrapper -->

    <?php scripts() ?>
    <script type="text/javascript">
        $("#nav_dashboard").addClass("active");
    </script>

        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD92qfrn02U9jYfAMcBNCnGI9IZ5pNDwTU">
        </script>

        <script type="text/javascript">
            google.maps.event.addDomListener(window, 'load', renderMap);
        </script>


    <script type="text/javascript">

        function findDataWithYear(data, year) {
            for(var i = 0; i < data.length; i++) {
                if(data[i].y == year) return data[i];
            }
            return null;
        }

        var stores = <?php echo(json_encode($stores)) ?>;
        var years = <?php echo(json_encode($years)) ?>;
        var quantityPerOnlineStore = <?php echo(json_encode($quantityPerOnlineStore)) ?>;

        var labels = []
        var barData = []

        for(var i = 0; i < stores.length; i++) {
            labels.push(stores[i].StoreName);
        }

        for(var i = 0; i < years.length; i++) {
            var year = years[i][0];
            barData.push({y:year});
        }

        for (var i = 0; i < quantityPerOnlineStore.length; i++) {
            var dataItem = findDataWithYear(barData, quantityPerOnlineStore[i][1]);
            dataItem[quantityPerOnlineStore[i][0]] = quantityPerOnlineStore[i][2];
        }

        Morris.Bar({
            element: 'bar-example',
            data: barData,
            xkey: 'y',
            ykeys: labels,
            labels: labels
        });


        var sales = <?php echo(json_encode($sales)) ?>;
        var onlinesales = <?php echo(json_encode($onlinesales)) ?>;

        chartData = [];

        var ctr = 1;
        sales.forEach(function(sale){
            chartData.push({d:sale.Date,sales:ctr});
            ctr++;
        });
        var ctr = 1;
        onlinesales.forEach(function(sale){
            chartData.push({d:sale.Date,onlinesales:ctr});
            ctr++;
        });

        // Line Chart
        Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'morris-line-chart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: chartData,
            // The name of the data record attribute that contains x-visitss.
            xkey: 'd',
            // A list of names of data record attributes that contain y-visitss.
            ykeys: ['sales','onlinesales'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Sales','Online Sales'],
            // Disables line smoothing
            smooth: true,
            resize: true
        });

    </script>



	</body>
</html>