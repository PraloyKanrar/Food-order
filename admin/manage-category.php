<?php
session_start();
include("partials/menu.php");
?>
<?php
include("../config/db.php");
?>

<div class="main-content">

    <div class="wrapper">
        <?php
        if(isset($_SESSION['cataddmsg'])){
           echo '<h4 style="text-align:center;color: green;font-weight: 700;">'. $_SESSION['cataddmsg'] .'</h4>';
           $_SESSION['cataddmsg']='';
        }
        ?>
    
        <h1>Mange Category</h1>

        <br>

<!-- Button to Add Admin -->
 <a href="add-category.php" class="btn-primary">Add Category</a>
 <br><br>

<table class="tbl-full">
     <tr>
         <th>Title</th>
         <th>Image_Name</th>
         <th>Featured</th>
         <th>Active</th>
         <th>Update</th>
         <th>Delete</th>
     </tr>
     <?php
        $sel="SELECT * FROM tbl_category";
        $rs=$con->query($sel);
        while($row=$rs->fetch_assoc()){

       
     
     ?>
     <tr>
         <td><?php echo $row['title'];?></td>
         <td><img src="admin_images/<?php echo $row['image_name'];?>" style="width: 100px;"></td>
         <td><?php echo $row['featured'];?></td>
         <td><?php echo $row['active'];?></td>
         
         <td><a href="update-category.php?eid=<?php echo $row['id'];?>" class="btn-Secondary">Update</a></td>
         <td><a href="delete-category.php?did=<?php echo $row['id'];?>" class="btn-danger">Delete</a></td>
     </tr>

     <?php } ?>
     
</table>
    </div>
    
</div>

<?php

include("partials/footer.php");
?>