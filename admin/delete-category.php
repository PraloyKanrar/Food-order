
<?php
include("../config/db.php");
?>

<?php
    //Get the ID of ADMIN to be deleted

    $id= $_GET['did'];

    // Create SQL query To delete Admin
    
    $sel="SELECT * FROM tbl_category  WHERE id='$id'";
    $rs=$con->query($sel);
    $row=$rs->fetch_assoc();

    unlink("admin_images/" . $row['image_name']);

    $del="DELETE FROM tbl_category WHERE id='$id'";
    if($con->query($del)){
        header("location:manage-category.php");
    }








?>