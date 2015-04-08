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
                        Activity History
                     </h1>
                     <ol class="breadcrumb">
                        <li>
                           <i class="fa fa-dashboard"></i> <a href="protected.php">Dashboard</a>
                        </li>
                        <li class="active">
                           <i class="fa fa-history"></i> Activity History
                        </li>
                     </ol>
                  </div>
               </div>

               <hr>

               <ul class="nav nav-tabs">
                  <li role="presentation" class="tab active"><a class="activityTabAnalytics" id="Sale" href="#Sales">Sales</a></li>
                  <li role="presentation"><a class="activityTabAnalytics" id="OnlineSale" href="#OnlineSales">Online Sales</a></li>
                  <li role="presentation"><a class="activityTabAnalytics" id="Repair" href="#Repairs" href="#">Repairs</a></li>
                  <li role="presentation"><a class="activityTabAnalytics" id="Upgrade" href="#Upgrades">Upgrades</a></li>
                  <li role="presentation"><a class="activityTabAnalytics" id="Install" href="#Installs">Installs</a></li>
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
         
             renderTableAnalytics("Sale");
         
         });
         
         $("#nav_analytics").addClass("active");
      </script>
   </body>
</html>