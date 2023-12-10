<?php
session_start();
@include 'dbcon.php';

if(!isset($_SESSION['user_id'])){
  header("location:login.php");
  die();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="CSS/profile.css" />
    <link rel="icon" href="IMAGES/PLACEHOLDERS/LOGO.png" type="image/png">
    <title>Profile</title>
  </head>
  <body>
  <?php
      $currentUser = $_SESSION['user_id'];
      $query = "SELECT * FROM user_tbl WHERE user_id = '$currentUser'";
      $query_run = mysqli_query($con, $query);

      if(mysqli_num_rows($query_run)>0){
        $user = mysqli_fetch_array($query_run);
    ?>

    <div class="container">
    <?php include "includes/navbar.php"?>
    <form action="code.php" method = "POST" enctype="multipart/form-data">
        <h1>Profile</h1>
        <header class="header">

            <div class="image">
    
                <img src="IMAGES/<?=$user['profilePic'];?>" alt="" />
              </div>

          <div class="content">
            <input type="hidden" name= "user_id" value ="<?= $user['user_id'];?>"/>
            <div class="form-floating mb-4 me-4 ">
            <p class = "form-control">
              <?=$user['Fname'];?>
            </p>
                <label for="floatingInput">First Name</label>
              </div>

              <div class="form-floating mb-4 me-4 ">
              <p class = "form-control">
              <?=$user['Lname'];?>
            </p>
                <label for="floatingInput"> Last Name</label>
              </div>

              <div class="form-floating mb-4 me-4 ">
              <p class = "form-control">
                <?=$user['bday'];?>
            </p>
                <label for="floatingInput">Birthday</label>
              </div>

              <div class="form-floating mb-4 me-4 ">
              <p class = "form-control">
              <?=$user['gender'];?>
            </p>
            </p>
                <label for="floatingInput">GENDER</label>
              </div>

              <div class="form-floating mb-4 me-4 ">
              <p class = "form-control">
              <?=$user['phone'];?>
            </p>
            </p>
                <label for="floatingInput">Phone Number</label>
              </div>

              <div class="form-floating mb-4 me-4 ">
              <p class = "form-control">
              <?=$user['email'];?>
            </p>
                <label for="floatingInput"> Email</label>
                <a href="profile.php" class="btn btn-outline-dark mt-4 ">EDIT</a>
                <a href="index.php" class="btn btn-outline-dark mt-4 ">BACK</a>
              </div>


          </div>
        </header>
        </form>
      </div>
      <?php include '<includes/footer.php' ?>


      <?php
          }
?> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>