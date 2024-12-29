<?php
session_start();
include("partials/menu.php");
include("../config/db.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1> Add Category </h1>
        <br>

        <!-- Add category from start Here -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" placeholder="Enter the tilte"></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="image_name" ></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-Secondary">

                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category from End Here -->
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
    $title=$_POST['title'];

    $bff=$_FILES['image_name']['tmp_name'];
    $image_name=time().$_FILES['image_name']['name'];
    move_uploaded_file($bff,"admin_images/".$image_name);

    if(isset($_POST['featured'])){

        $featured=$_POST['featured'];

    }else{
        $featured="No";

    }

    if(isset($_POST['active'])){

        $active=$_POST['active'];

    }else{
        $active="No";

    }

    // SQL Query to save the data into database

    $ins="INSERT INTO  tbl_category SET title= '$title', image_name='$image_name' , featured='$featured', active='$active'";
    if($con->query($ins)){
        $_SESSION['cataddmsg'] = 'Catagary Successfully Added !!';
        header("location:manage-category.php");
    }



}

?>