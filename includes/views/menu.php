<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 2015-03-28
 * Time: 8:14 PM
 */

function menu()
{

    echo '<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php"><i class="fa fa-desktop"></i> Joviani Computer Store</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> ' . $_SESSION['username'] . '<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="nav_dashboard">
                        <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li id="nav_inventory">
                        <a href="inventory.php"><i class="fa fa-fw fa-tasks"></i> Inventory</a>
                    </li>
                    <li id="nav_orders">
                        <a href="orders.php"><i class="fa fa-fw fa-truck"></i> Orders</a>
                    </li>';


    if ($_SESSION["privelege"] == 'admin') {
        echo '<li id="nav_employees">
                    <a href="employees.php"><i class="fa fa-fw fa-group"></i> Employees</a>
                </li>
                <li id="nav_analytics">
                    <a href="analytics.php"><i class="fa fa-fw fa-bar-chart-o"></i> Analytics</a>
                </li>';
    }


    echo '
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>';
}

?>