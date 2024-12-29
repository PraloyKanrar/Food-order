<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php 
        // Initialize the search variable
        $search = "";

        // Check if the 'search' key exists in $_POST
        if (isset($_POST['search'])) {
            // Get the search keyword and escape special characters
            $search = mysqli_real_escape_string($con, $_POST['search']);
        }
        ?>

        <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo htmlspecialchars($search); ?>"</a></h2>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php 
        if ($search !== "") {
            // SQL Query to Get foods based on search keyword
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            // Execute the Query
            $res = mysqli_query($con, $sql);

            // Count Rows
            $count = mysqli_num_rows($res);

            // Check whether food available or not
            if ($count > 0) {
                // Food Available
                while ($row = mysqli_fetch_assoc($res)) {
                    // Get the details
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                            // Check whether image name is available or not
                            if ($image_name == "") {
                                // Image not Available
                                echo "<div class='error'>Image not Available.</div>";
                            } else {
                                // Image Available
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

                            <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            } else {
                // Food Not Available
                echo "<div class='error'>Food not found.</div>";
            }
        } else {
            echo "<div class='error'>No search term provided.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
