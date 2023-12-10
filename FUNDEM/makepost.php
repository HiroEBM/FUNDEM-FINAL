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
      <link rel="icon" href="IMAGES/PLACEHOLDERS/LOGO.png" type="image/png">
   
    <link rel="stylesheet" href="CSS/profile.css"/>
    <title>Make a Post</title>
  </head>
  <body>
   
    <div class="container">
    <?php include ('includes/navbar.php');?>

    <form action="code.php" method = "POST" enctype="multipart/form-data">
        
        <h1>Create Post</h1>
        <header class="header">

            <div class="image">
    
                <img src="IMAGES/PLACEHOLDERS/fund.png" alt="header image"  />

                <div class="input-photo-position">
                <input type="file" id="myFile" name="filename" class="img-upload" accept="image/jpg, image/jpeg, image/png" />
                <label class="file-btn" for="myFile">Upload a Photo</label>
                  </div>

              </div>

          <div class="content">
            <div class="form-floating mb-4 me-4 ">
                <input type="text" name="title" class="form-control" id="floatingInput" placeholder="Title">
                <label for="floatingInput">Title</label>
              </div>

              <div class="form-floating mb-4 me-4">
                <textarea class="form-control" name="story" id="Story" style="height: 200px"></textarea>
                <label for="floatingTextarea2">Story</label>
              </div>

              <div class="form-floating mb-4 me-4 ">
                <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount">
                <label for="floatingInput"> Target Amount</label>
              </div>

              <button type= "file" name="upload-post" class="btn btn-outline-dark mt-4 ">Upload</button>


          </div>
         
        </header>
      </div>
      <?php include '<includes/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
  </body>
</html>