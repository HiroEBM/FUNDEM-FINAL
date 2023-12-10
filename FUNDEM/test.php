<?php
session_start(); // Start the session at the beginning of your PHP code

if (isset($_GET['create_id']) && isset($_GET['user_id'])) {
    $_SESSION['viewed_post_create_id'] = $_GET['create_id'];
    $_SESSION['viewed_post_user_id'] = $_GET['user_id'];
    header("Location: viewpost.php");
    // Now you can use these session variables to display details of the viewed post
    // Implement your logic here...
} else {
    // Handle the case where the required parameters are not set
    // Redirect to an error page or display a message
}
?>