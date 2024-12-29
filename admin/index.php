

<?php
session_start();
include("partials/menu.php");
include("../config/db.php");
?>

        <!-- Main Section Starts -->
            <div class="main-content">
                 <div class="wrapper">
                   <h1>Dashboard</h1>
                   <div class="col-4 text-center">
                   <?php
                         $sel = "SELECT * FROM tbl_category";
                         $rs = $con->query($sel);

                         // Check if the query was successful
                         if ($rs) {
                         // Count rows if the result object is valid
                         $count = mysqli_num_rows($rs);
                         echo "<h1>Total Categories: . $count</h1>";
                         } else {
                         // Handle query failure
                         echo "Error: " . $con->error;
                         }
                    ?>
                     
                   </div>
                   <div class="col-4 text-center">
                    <?php
                         $sel = "SELECT * FROM tbl_food";
                         $rs = $con->query($sel);

                         // Check if the query was successful
                         if ($rs) {
                         // Count rows if the result object is valid
                         $count = mysqli_num_rows($rs);
                         echo "<h1>Total FOOD:  . $count </h1>";
                         } else {
                         // Handle query failure
                         echo "Error: " . $con->error;
                         }
                    ?>
                        
                   </div>
                   <div class="col-4 text-center">
                   <?php
                         $sel = "SELECT * FROM tbl_order";
                         $rs = $con->query($sel);

                         // Check if the query was successful
                         if ($rs) {
                         // Count rows if the result object is valid
                         $count = mysqli_num_rows($rs);
                         echo "<h1> Total ORDER:  . $count</h1>";
                         } else {
                         // Handle query failure
                         echo "Error: " . $con->error;
                         }
                    ?>
                        
                   </div>
                   <div class="col-4 text-center">
                   <?php
                         $sel = "SELECT SUM(total) AS TOTAL  FROM tbl_order WHERE status = 'Delivered'";
                         $rs = $con->query($sel);

                         $row = $rs->fetch_assoc();

                       $totla_revenue = $row['TOTAL'];
                         
                    ?>
                        <h1>$<?php echo  $totla_revenue; ?></h1>
                        <br>
                        Revenue Generated
                   </div>
                   <div class="clearfix"></div>
                </div>

            </div>
            
        <!-- Main Section Ends -->
<?php

include("partials/footer.php");
?>