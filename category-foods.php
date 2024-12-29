<?php
include("partials-front/menu.php");
?>

<?php
// Check whether id is passed or not
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Get category title based on category id
    $sel = "SELECT title FROM tbl_category WHERE id='$category_id'";
    // Execute the query
    $rs = $con->query($sel);

    // Check if a result was returned
    if ($rs->num_rows > 0) {
        // Get the value from the database
        $row = $rs->fetch_assoc();
        // Get the title
        $category_title = $row['title'];
    } else {
        // Redirect to home page if category does not exist
        header("location:" . $base_url);
    }
} else {
    header("location:" . $base_url);
}
?>

<!-- FOOD SEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>
    </div>
</section>
<!-- FOOD SEARCH Section Ends Here -->

<!-- FOOD MENU Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        // Create SQL query to display foods from the selected category
        $sql2 = "SELECT * FROM tbl_food WHERE category_id='$category_id'";
        // Execute the query
        $res2 = mysqli_query($con, $sql2);

        // Count rows to check whether the category has any food items
        $count2 = mysqli_num_rows($res2);

        if ($count2 > 0) {
            // Food items available
            while ($row = mysqli_fetch_assoc($res2)) {
                // Get the values like id, title, image_name
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        // Check whether image is available or not
                        if ($image_name == "") {
                            // Display message
                            echo "<div class='error'>Image not Available</div>";
                        } else {
                            // Image available
                            ?>
                            <img src="<?php echo $base_url; ?>admin/category-image/<?php echo $image_name; ?>" alt="<?php echo htmlspecialchars($title); ?>" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo htmlspecialchars($title); ?></h4>
                        <p class="food-price">$<?php echo htmlspecialchars($price); ?></p>
                        <p class="food-detail">
                            <?php echo htmlspecialchars($description); ?>
                        </p>
                        <br>

                        <a href="<?php echo $base_url; ?>order.php?food_id=<?php echo $id; ?> class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                <?php
            }
        } else {
            // No food items in this category
            echo "<div class='error'>No food items found in this category.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- FOOD MENU Section Ends Here -->

<?php
include("partials-front/footer.php");
?>
