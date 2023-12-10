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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/makepost.css" />
    <link rel="icon" href="IMAGES/PLACEHOLDERS/LOGO.png" type="image/png">
    <title>Make a Post</title>
  </head>
  <body>
   
    <div class="container">
    <?php include ('includes/navbar.php');?>
    <?php

      $user_frid = $_SESSION['viewed_post_user_id'];
      $create_id = $_SESSION['viewed_post_create_id'];
     
      $query = "SELECT * FROM create_blog WHERE create_id = '$create_id'";
      $query_run = mysqli_query($con, $query);



      if(mysqli_num_rows($query_run)>0){
        $post = mysqli_fetch_array($query_run);
    ?>

        <form action="code.php" method = "POST" enctype="multipart/form-data">
        <h1>Edit Post</h1>
        <br>
        <header class="header">

            <div class="image">
    
                <img src="IMAGES/<?= $post['image'];?>" alt="https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg"/>

                <div class="input-photo-position">
                <input type="file" id="myFile" name="filename" class="img-upload" accept="image/jpg, image/jpeg, image/png" />
                <label class="file-btn" for="myFile">Upload a Photo</label>
                  </div>

              </div>

          <div class="content">
            <div class="form-floating mb-4 me-4 ">
            <input type="hidden" name= "create_id" value ="<?= $post['create_id'];?>"/>
                <input type="text" name="title" class="form-control" id="floatingInput" value = '<?= $post['title'];?>'>
                <label for="floatingInput">Title</label>
              </div>

              <div class="form-floating mb-4 me-4">
                <textarea class="form-control" name="story" id="Story" style="height: 200px" value = '<?= $post['story'];?>'></textarea>
                <label for="floatingTextarea2">Story</label>
              </div>

              <div class="form-floating mb-4 me-4 ">
                <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value = '<?= $post['amount'];?>'>
                <label for="floatingInput"> Target Amount</label>
              </div>

              <button type= "submit" name="update-post" class="btn btn-outline-dark mt-4 ">Save Changes</button>
              
              <form action="code.php" method = "POST" enctype="multipart/form-data">
                <button type= "submit" name="delete-post" value="<?= $post['create_id'];?>" class="btn btn-outline-dark mt-4 ">Delete</button>
              </form>

          </div>
      </form>
        </header>
      </div>
      <?php
            }
          
?> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
  </body>
</html>