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
    <link rel="stylesheet" href="CSS/profile.css" />
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
    <?php include ('includes/navbar.php');?>
    <form action="code.php" method = "POST" enctype="multipart/form-data">
        <h1>Profile</h1>
        <header class="header">

            <div class="image">
    
                <img src="IMAGES/<?=$user['profilePic'];?>" alt="header image"  />

                <div class="input-photo-position">
                <input type="file" id="myFile" name="filename" class="img-upload" accept="image/jpg, image/jpeg, image/png" />
                <label class="file-btn" for="myFile">Upload a Photo</label>
                  </div>
              </div>

          <div class="content">
            <input type="hidden" name= "user_id" value ="<?= $user['user_id'];?>"/>
            <div class="form-floating mb-4 me-4 ">
                <input type="text" name ="Fname" value ="<?= $user['Fname']; ?>" class="form-control" id="first-name" placeholder="First_Name">
                <label for="floatingInput">First Name</label>
              </div>

              <div class="form-floating mb-4 me-4 ">
                <input type="text" name ="Lname" class="form-control" id="last-name" placeholder="Last_Name" value ="<?= $user['Lname'];?>"/>
                <label for="floatingInput"> Last Name</label>
              </div>

              <div class="form-floating mb-4 me-4 ">
                <input type="date" name ="bday" class="form-control" id="bdy" value = "<?=$user['bday'];?>" placeholder="mm-dd-yyyy">
                <label for="floatingInput">Birthday</label>
              </div>

              <div class="form-floating mb-4 me-4 ">
                <input type="text" name ="gender"class="form-control" id="sex" value ="<?= $user['gender'];?>"placeholder="Male/Female">
                <label for="floatingInput">Gender</label>
              </div>

              <div class="form-floating mb-4 me-4 ">
                <input type="number" name ="phone" class="form-control" id="number" value ="<?= $user['phone'];?>"placeholder="Number">
                <label for="floatingInput">Phone Number</label>
              </div>

              <div class="form-floating mb-4 me-4 ">
                <input type="email" name="email" class="form-control" id="" value ="<?= $user['email'];?>" placeholder="Email">
                <label for="floatingInput"> Email</label>
              </div>

              <button type="submit" name = "update_user" class="btn btn-outline-dark mt-4 ">Save Changes</button>
              <form action="code.php" method="POST" class="d-inline" enctype="multipart/form-data">
                <button type="submit" name="delete_user" value="<?= $user['user_id'];?>" class="btn btn-outline-dark mt-4 ">Delete Account</button>
              </form>
              <a href = "viewprofile.php" name = "back" class="btn btn-outline-dark mt-4 ">Back</a>
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