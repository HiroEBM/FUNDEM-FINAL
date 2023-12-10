<?php 
@include 'dbcon.php';
session_start();

if(isset($_SESSION['user_id'])){
  header("location:Regform.php");
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
    <title>Registration Form</title>
  </head>
  <body>
    <div class="signup-box">
      <h1>Sign Up</h1>
      <h4>It's free and only takes a minute</h4>
      <?php include('message.php'); ?>
      <form action = "code.php" method="POST">
        <label>First Name</label>
        <input
          type="text"
          id="f_name"
          value="<?= isset($fname) ? $fname : '' ?>"
          placeholder="Enter First Name"
          name="f_name"
          required
        />
        <label>Last Name</label>
        <input
          type="text"
          id="l_name"
          value="<?= isset($lname) ? $lname : '' ?>"
          placeholder="Enter Last Name"
          name="l_name"
          required
        />
        <label>Email</label>
        <input
          type="email"
          id="email"
          value="<?= isset($email) ? $email : '' ?>"
          placeholder="Enter Email"
          name="email"
          required
        />
        <label>Phone</label>
        <input type="tel" id="phone" name="phone" placeholder="09XXXXXXXXX" required/>
        <label>Password</label>
        <input
          type="password"
          id="pwd"
          placeholder="*************"
          name="password"
          required
        />
        <label>Confirm Password</label>
        <input
          type="password"
          id="confirm_pwd"
          placeholder="*************"
          name="confirm_password"
          required
        />
        <label for="gender">GENDER:</label>
        <select name="gender" id="gender">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        <br>
        <button type="submit" id="regUser" name="register_user" class="Signup">
              Register
    </button>
      </form>
      <p class="para-2-reg">
        Already have an account? <a href="Login.php">Login here</a>
      </p>
    </div>
      
    </body>
</html>
