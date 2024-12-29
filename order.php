<?php
include("partials-front/menu.php");
?>

<?php 
// Check whether food_id is set or not
if (isset($_GET['food_id'])) {
    $food_id = intval($_GET['food_id']); // Get and validate food_id

    // Get details of the selected food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    $res = mysqli_query($con, $sql);

    if ($res) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            // Fetch data
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        } else {
            header('location:' . $base_url); // Redirect if no data found
            exit;
        }
    } else {
        echo "SQL Query failed: " . mysqli_error($con); // Debugging
        exit;
    }
} else {
    header('location:' . $base_url); // Redirect if food_id not set
    exit;
}
?>

<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="post" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php 
                    if ($image_name == "") {
                        echo "<div class='error'>Image not Available.</div>";
                    } else {
                        ?>
                        <img src="<?php echo $base_url; ?>admin/category-image/<?php echo $image_name; ?>" alt="Food Image" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="food-price">$<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. John Doe" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 1234567890" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. example@gmail.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>

        <?php 
        if (isset($_POST['submit'])) {
            $food = $_POST['food'];
            $price = floatval($_POST['price']);
            $qty = intval($_POST['qty']);
            $total = $price * $qty;
            $order_date = date("Y-m-d H:i:s");
            $status = "Ordered";
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            $sql2 = "INSERT INTO tbl_order SET 
                food = '$food',
                price = $price,
                qty = $qty,
                total = $total,
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'";

            if ($con->query($sql2)) {
                echo "Order placed successfully!";
            } else {
                echo "Failed to place order: " . $con->error;
            }
        }
        ?>
    </div>
</section>

<?php
include("partials-front/footer.php");
?>
