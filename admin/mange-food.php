<?php
include("partials/menu.php");
?>

<?php
include("../config/db.php");
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Mange Food</h1>
        <br>

<!-- Button to Add Admin -->
 <a href="add-food.php" class="btn-primary">Add Food</a>
 <br><br>

<table class="tbl-full">
     <tr>
         <th>Title</th>
         <th>Price</th>
         <th>Image_Name</th>
         <th>Featured</th>
         <th>Active</th>
         <th>Update</th>
         <th>Delete</th>
     </tr>
     <?php
        $sel="SELECT * FROM tbl_food";
        $rs=$con->query($sel);
        while($row=$rs->fetch_assoc()){

     ?>
     <tr>
        <td><?php echo $row['title'];?></td>
        <td><?php echo $row['price'];?></td>
        <td><img src="category-image/<?php echo $row['image_name'];?>" style="width: 100px;"></td>
        <td><?php echo $row['featured'];?></td>
        <td><?php echo $row['active'];?></td>
        <td><a href="update-food.php?eid=<?php echo $row['id'];?>"  class="btn-Secondary">Update</a></td>
        <td><a href="delete-food.php?did=<?php echo $row['id'];?>"  class="btn-danger">Delete</a></td>

     </tr>





            <?php } ?>
</table>
    </div>
    
</div>

<?php

include("partials/footer.php");
?>