<?php
include("partials/menu.php");
?>

<!-- Connection Database -->
<?php
include("../config/db.php");
?>

        <!-- Main Section Starts -->
            <div class="main-content">
                 <div class="wrapper">
                   <h1>Manage Admin</h1>
                   <br>

                   <!-- Button to Add Admin -->
                    <a href="add-admin.php" class="btn-primary">Add Admin</a>
                    <br><br>

                   <table class="tbl-full">
                        <tr>
                            <th>S-id</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                        <?php

                            $sel="SELECT * FROM tbl_admin";
                            $rs=$con->query($sel);
                            while($row=$rs->fetch_assoc()){
                        
                        ?>
                        <tr>
                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['full_name'];?></td>
                            <td><?php echo $row['username'];?></td>
                            

                            
                            <td><a href="update-admin.php?eid=<?php echo $row['id'];?>" class="btn-Secondary">Update</a></td>
                            <td><a href="delete-admin.php?did=<?php echo $row['id'];?>" class="btn-danger">Delete</a></td>
                        </tr>
                       <?php } ?>
                   </table>
                </div>

            </div>
            
        <!-- Main Section Ends -->

<?php

include("partials/footer.php");
?>