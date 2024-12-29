<?php
include("partials/menu.php");
?>

<?php
include("../config/db.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1> Add Admin </h1>
        <br>
        <form action="" method="post" >
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter The Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-Secondary">

                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

include("partials/footer.php");
?>

<?php



// Process the value from Form and save it in Database
// Check whether the submit button is clicked or not

if(isset($_POST['submit'])){

 

    // Get the Data From form
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    // SQL Query to save the data into database

    $ins="INSERT INTO  tbl_admin SET full_name= '$full_name', username='$username' , password='$password' ";
    if($con->query($ins)){
        header("location:manage-admin.php");
    }



}

?>