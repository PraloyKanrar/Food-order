<?php
include("partials/menu.php");
include("../config/db.php");

// Get the ID of the category to be updated
$id = $_GET['eid'];

// Fetch existing category details
$sel = "SELECT * FROM tbl_category WHERE id='$id'";
$rs = $con->query($sel);
$row = $rs->fetch_assoc();
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td><input type="hidden" name="category_id" value="<?php echo $row['id']; ?>"></td>
                </tr>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Enter the title" value="<?php echo $row['title']; ?>"></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <input type="file" name="image_name">
                        <br>
                        <?php if ($row['image_name'] != ""): ?>
                            <img src="admin_images/<?php echo $row['image_name']; ?>" style="width: 100px;">
                        <?php endif; ?>
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
                        <input type="submit" name="submit" value="Update Category" class="btn-Secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    // Get the data from the form
    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
    $active = isset($_POST['active']) ? $_POST['active'] : "No";

    // Check if a new image is uploaded
    if ($_FILES['image_name']['name'] != "") {
        // Delete the existing image if any
        if ($row['image_name'] != "" && file_exists("admin_images/" . $row['image_name'])) {
            unlink("admin_images/" . $row['image_name']);
        }

        // Upload the new image
        $image_name = time() . "_" . $_FILES['image_name']['name'];
        $bff = $_FILES['image_name']['tmp_name'];
        move_uploaded_file($bff, "admin_images/" . $image_name);

        // Update query with the new image
        $upd = "UPDATE tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active' WHERE id='$category_id'";
    } else {
        // Update query without changing the image
        $upd = "UPDATE tbl_category SET title='$title', featured='$featured', active='$active' WHERE id='$category_id'";
    }

    // Execute the query
    if ($con->query($upd)) {
        header("location:manage-category.php");
        exit(); // Ensure the script stops after redirecting
    } else {
        echo "<div class='alert alert-danger'>Failed to update category.</div>";
    }
}

include("partials/footer.php");
?>
