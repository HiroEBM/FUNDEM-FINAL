<?php
session_start(); // Start the session at the beginning of your PHP code
$create_id = $_SESSION['viewed_post_create_id'];
$user_id = $_SESSION['viewed_post_user_id'];


echo ($create_id);
echo ($user_id);
?>