<?php
include("partials/menu.php");
?>

<?php
include("../config/db.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1> Add Food </h1>
        <br>

        <!-- Add category from start Here -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" placeholder="Enter the tilte"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea  name="description" placeholder="Description of the Food" cols="30" rows="5"></textarea></td>
                </tr>
                <tr>
                    <td>Price :</td>
                    <td><input type="number" name="price" ></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="image_name" ></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category_id">
                            <?php
                            // Create SQL to get all active categories from the database
                            $sel = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $rs = $con->query($sel);

                            // Check if the query returned rows
                            if ($rs && $rs->num_rows > 0) {
                                // We have categories
                                while ($row = $rs->fetch_assoc()) {
                                    // Get the details of the category
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    <?php
                                }
                            } else {
                                // No categories found
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }
                            ?>
                        </select>

                    </td>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-Secondary">

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
if (isset($_POST['submit'])) {
    // Get the Data From form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle image upload
    $bff = $_FILES['image_name']['tmp_name'];
    $image_name = time() . $_FILES['image_name']['name'];
    move_uploaded_file($bff, "category-image/" . $image_name);

    $category_id = $_POST['category_id'];

    // Set featured and active values
    $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
    $active = isset($_POST['active']) ? $_POST['active'] : "No";

    // SQL Query to save the data into database
    $ins = "INSERT INTO tbl_food SET 
            title='$title', 
            description='$description', 
            price='$price', 
            image_name='$image_name', 
            category_id='$category_id', 
            featured='$featured', 
            active='$active'";

    if ($con->query($ins)) {
        // Redirect to manage food page after successful insertion
        header("location:mange-food.php");
    } else {
        // Display error if query fails
        echo "Error: " . $con->error;
    }
}
?>
