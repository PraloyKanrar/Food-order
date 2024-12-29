<?php
include("partials/menu.php");


include("../config/db.php");


?>

<div class="main-content">
    <div class="wrapper">
        <h1>Mange Order</h1>
        <br>

<!-- Button to Add Admin -->
 <a href="#" class="btn-primary">Add Admin</a>
 <br><br>

<table class="tbl-full">
     <tr>
         <th>Food</th>
         <th>Price</th>
         <th>Qty</th>
         <th>Total</th>
         <th>Order Date</th>
         <th>Stutas</th>
         <th>Customer Name</th>
         <th>Customer Email</th>
         <th>Customer Contact</th>
         <th>Customer Address</th>
         <th>Action </th>
     </tr>
     <?php
        $sel="SELECT * FROM tbl_order";
        $rs=$con->query($sel);
        while($row=$rs->fetch_assoc()){

       
     
     ?>
     <tr>
         <td><?php echo $row['food'];?></td>
         <td><?php echo $row['price'];?></td>
         <td><?php echo $row['qty'];?></td>
         <td><?php echo $row['total'];?></td>
         <td><?php echo $row['order_date'];?></td>
         <td><?php echo $row['status'];?></td>
         <td><?php echo $row['customer_name'];?></td>
         <td><?php echo $row['customer_contact'];?></td>
         <td><?php echo $row['customer_email'];?></td>
         <td><?php echo $row['customer_address'];?></td>
         <td><a href="update-order.php?eid=<?php echo $row['id'];?>" class="btn-Secondary">Update</a></td>
         <td><a href="delete-order.php?did=<?php echo $row['id'];?>" class="btn-danger">Delete</a></td>
     </tr>
     <?php } ?>
</table>
    </div>
    
</div>

<?php

include("partials/footer.php");
?>