<?php
session_start();
@include 'dbcon.php';

if(isset($_SESSION['user_id'])){
  header("location:index.php");
  die();
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="CSS/login.css" />
    <link rel="icon" href="IMAGES/PLACEHOLDERS/LOGO.png" type="image/png">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <title>SignIn</title>
  </head>
  <body>


    <div class="login-box">
    <h1>Login</h1>
    <?php include('message.php'); ?>
      <form action = "code.php" method="POST">
        <label>Email</label>
        <input
          type="email"
          id="email"
          placeholder="Enter Email"
          value="<?= isset($email) ? $email : '' ?>"
          name="email"
          required
        />
        <label>Password</label>
        <input
          type="password"
          id="pwd"
          placeholder="*************"
          name="password"
          required
        />
        <button type="submit" name="login_user" class="Signup">
              Log in
    </button>
      </form>
      <p class="para-2-log">
        Already have an account? <a href="Regform.php">Register here</a>
      </p>
    </div>

    
    </body>
</html>
