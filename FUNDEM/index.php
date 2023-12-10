<?php 
@include 'dbcon.php';
session_start();

if(!isset($_SESSION['user_id'])){
  header("location:login.php");
  die();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link rel="icon" href="IMAGES/PLACEHOLDERS/LOGO.png" type="image/png">

    <link rel="stylesheet" href="CSS/style.css" /> 
    <title>FUNDEM</title>
  </head>
  <body>

    <div class="container">
    <?php include ('includes/navbar.php');?>

     <!-- CONTENT BODY-->

      <header class="header">
        <div class="content">
          <h1>FIND THEM AND HELP THEM</h1>
          <p>
            Join our 'Encourage Dreams' fundraiser to make a lasting impact, 
            supporting education, sustainability, and healthcare 
            initiatives for a brighter, better future.
          </p>
          <button id = "create" class="btn-1">Create</button>
          <button class="btn-2">Discover</button>
        </div>
        <div class="image">
          <span class="image__bg"></span>
          <img src="IMAGES/PLACEHOLDERS/main.png" alt="header image" />
        </div>
      </header>
    </div>

    <!--this is for Card section-->

    <div class="container-1">
     
        <div class="box-container">
          <?php
            $query = 'SELECT * FROM create_blog';
            $query_run = mysqli_query($con, $query);
              while($row = mysqli_fetch_assoc($query_run)){

                $sql = 'SELECT * FROM user_tbl';
                $sql_run = mysqli_query($con, $sql);

                while($rows = mysqli_fetch_assoc($sql_run)){

              if($row['user_id'] === $rows['user_id'] ){
          ?>
            <div class="box">
              <img src="IMAGES/<?= $row['image']?>">
              <h3><?= $row['title']?></h3>
              <p>
                <strong>Name:</strong> <?= $rows['Fname'];?>
                                       <?= $rows['Lname'];?>
                                       <br>
                <strong>Email:</strong> <?= $rows['email'];?>
                <br>
                <strong>Phone:</strong> <?= $rows['phone'];?><br>
                <strong>Amount:</strong> ₱<?= $row['d_count'];?>/<strong><?= $row['amount'];?></strong>
                <br>
                <strong>Recent Donator:</strong> <?= $row['donator'];?>
                  </p>
              
     
           
              <a href="test.php?create_id=<?= $row['create_id'] ?>&user_id=<?= $rows['user_id'] ?>" class="btn">VIEW</a>
          </div>
    <?php
                }
              }
    }
            
    ?> 
    
    </div>

     <!--About Section-->
     <div class="about-section">

<h1>About</h1>
<h4>FIND THEM AND HELP THEM</h4>
<div class="vis-mis">
<div class="vision">
  <h5>Vision</h5>

  <p>To create a world where every individual has the 
    opportunity to thrive, achieve their fullest potential, 
    and live in harmony with the global community.</p>
  </div>


<div class="mission">
  <h5>Mision</h5>
  <p>Empower and inspire positive change by fostering education, 
    promoting sustainability, and advancing healthcare initiatives, 
    to build a resilient and equitable future for all.</p>
</div>
</div>
</div>
        </div>
   
      
    </div>
  <?php include '<includes/footer.php' ?>
    
<script>
// click discover
      document.getElementById("create").addEventListener("click", toSignup);
      function toSignup(){
        window.location = "makepost.php"; 
        }
        document.addEventListener('DOMContentLoaded', function () {
          
          let discoverButton = document.querySelector('.btn-2');
         let container1 = document.querySelector('.container-1');
  
         
          discoverButton.addEventListener('click', function () {
       
            container1.scrollIntoView({ behavior: 'smooth' });
          });
        });

   //click about

   document.addEventListener('DOMContentLoaded', function () {
  
    let aboutLink = document.querySelector('a[href="#about"]');

  
    let aboutSection = document.querySelector('.about-section');

 
    aboutLink.addEventListener('click', function () {

      aboutSection.scrollIntoView({ behavior: 'smooth' });
    });
  });

      </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>