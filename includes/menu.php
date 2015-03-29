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
                <a class="navbar-brand" href="index.html"><i class="fa fa-desktop"></i> Joviani Computer Store</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>' . $_SESSION['username'] . '<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="protected.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="inventory.php"><i class="fa fa-fw fa-tasks"></i> View Inventory</a>
                    </li>';


    if ($_SESSION["privelege"] == 'admin') {
        echo '<li>
                        <a href="employees.php"><i class="fa fa-fw fa-group"></i> Manage Employees</a>
                    </li><li>
                        <a href="analytics.php"><i class="fa fa-fw fa-bar-chart-o"></i> Sale Analytics</a>
                    </li>';
    }


    echo '
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>';
}

?>