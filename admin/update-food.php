<?php
include("../config/db.php");
?>

<?php
// Get the ID of the food to be updated
$id = $_GET['eid'];

// Fetch the food details from the database
$sel = "SELECT * FROM tbl_food WHERE id='$id'";
$rs = $con->query($sel);
$row = $rs->fetch_assoc();
?>

<?php
include("partials/menu.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1> Update Food </h1>
        <br>

        <!-- Update Food Form -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td><input type="hidden" name="upd_food" value="<?php echo $row['id']; ?>"></td>
                </tr>
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" placeholder="Enter the title" value="<?php echo $row['title']; ?>"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" placeholder="Description of the Food" cols="30" rows="5"><?php echo $row['description']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Price :</td>
                    <td><input type="number" name="price" value="<?php echo $row['price']; ?>"></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <input type="file" name="image_name">
                        <img src="category-image/<?php echo $row['image_name']; ?>" style="width: 100px;">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category_id">
                            <?php
                            $cat_sel = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $cat_rs = $con->query($cat_sel);

                            if ($cat_rs->num_rows > 0) {
                                while ($cat_row = $cat_rs->fetch_assoc()) {
                                    $selected = $row['category_id'] == $cat_row['id'] ? 'selected' : '';
                                    echo "<option value='{$cat_row['id']}' $selected>{$cat_row['title']}</option>";
                                }
                            } else {
                                echo "<option value='0'>No Category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if ($row['featured'] == 'Yes') echo "checked"; ?>> Yes
                        <input type="radio" name="featured" value="No" <?php if ($row['featured'] == 'No') echo "checked"; ?>> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if ($row['active'] == 'Yes') echo "checked"; ?>> Yes
                        <input type="radio" name="active" value="No" <?php if ($row['active'] == 'No') echo "checked"; ?>> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Food" class="btn-Secondary">
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
// Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // Get the Data From form
    $upd_food = $_POST['upd_food'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
    $active = isset($_POST['active']) ? $_POST['active'] : "No";

    // Handle image upload
    if ($_FILES['image_name']['name'] != "") {
        $bff = $_FILES['image_name']['tmp_name'];
        $image_name = time() . "_" . $_FILES['image_name']['name'];
        move_uploaded_file($bff, "category-image/" . $image_name);

        // Update with image
        $upd = "UPDATE tbl_food SET 
            title='$title', 
            description='$description', 
            price='$price', 
            image_name='$image_name', 
            category_id='$category_id', 
            featured='$featured', 
            active='$active' 
            WHERE id='$upd_food'";
    } else {
        // Update without image
        $upd = "UPDATE tbl_food SET 
            title='$title', 
            description='$description', 
            price='$price', 
            category_id='$category_id', 
            featured='$featured', 
            active='$active' 
            WHERE id='$upd_food'";
    }

    // Execute the query
    if ($con->query($upd) === TRUE) {
        header("Location: mange-food.php");
    } else {
        echo "Error updating record: " . $con->error;
    }
}
?>
