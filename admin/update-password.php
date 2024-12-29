<?php
include("partials/menu.php");
include("../config/db.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>

        <?php
        // Validate if `pid` exists in the URL
        if (isset($_GET['pid'])) {
            $pid = $_GET['pid'];
        } else {
            echo "<div class='alert alert-danger'>No admin selected. Redirecting...</div>";
            header("Refresh: 3; url=manage-admin.php"); // Redirect after 3 seconds
            exit();
        }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td><input type="hidden" name="pid_name" value="<?php echo $pid; ?>"></td>
                </tr>

                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="old_password" placeholder="Current Password" required></td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="Enter The New Password" required></td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password" required></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    // Retrieve form data
    $pid = $_POST['pid_name'];
    $old_password = md5($_POST['old_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // Verify the old password
    $ps = "SELECT * FROM tbl_admin WHERE id='$pid' AND password='$old_password'";
    $rs = $con->query($ps);

    if ($rs->num_rows > 0) {
        // Check if new and confirm passwords match
        if ($new_password === $confirm_password) {
            // Update the password
            $update = "UPDATE tbl_admin SET password='$new_password' WHERE id='$pid'";
            if ($con->query($update)) {
                echo "<div class='alert alert-success'>Password updated successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Failed to update password. Please try again.</div>";
            }
        } else {
            echo "<div class='alert alert-warning'>New password and confirm password do not match!</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Current password is incorrect!</div>";
    }
}
?>
