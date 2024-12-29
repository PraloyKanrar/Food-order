<?php
include("partials/menu.php");

?>


<?php
include("../config/db.php");
?>

<?php
    //Get the ID of ADMIN to be deleted

    $id= $_GET['eid'];

    // Create SQL query To delete Admin
    
    $sel="SELECT * FROM tbl_admin  WHERE id='$id'";
    $rs=$con->query($sel);
    $row=$rs->fetch_assoc();
?>

<div class="main-content">
    <div class="wrapper">
        <h1> Update Admin </h1>
        <br>
        <form action="" method="post" >
            <table class="tbl-30">
                <tr>
                    <td><input type="hidden" name="adminupd"  value="<?php echo $row['id'];?>"></td>
                </tr>
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name" value="<?php echo $row['full_name'];?>"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter Your Username" value="<?php echo $row['username'];?>"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter The Password" value="<?php echo $row['password'];?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Admin" class="btn-Secondary">

                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php



// Process the value from Form and save it in Database
// Check whether the submit button is clicked or not

if(isset($_POST['submit'])){

 

    // Get the Data From form
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
   

    $adminupd=$_POST['adminupd'];

    // SQL Query to save the data into database

    $upd="UPDATE tbl_admin SET full_name= '$full_name', username='$username'  WHERE id='$adminupd'";
    if($con->query($upd)){
        header("location:manage-admin.php");
    }



}

?>

<?php

include("partials/footer.php");
?>
