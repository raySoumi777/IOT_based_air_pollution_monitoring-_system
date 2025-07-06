<?php 
    include("config.php");
    session_start();
    if(!isset($_SESSION['sno'])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="profile1.css">
  </style>
</head>
<body class="profilebody" style="background-image: linear-gradient(to right,rgb(0, 0, 0),rgb(0, 24, 142),rgb(0, 0, 0));">
    <h1 class="heading" style="text-align:center; font-size:56px; color:white">Welcome to your Profile</h1>
    <p style="text-align:center; color:white">This page contains all your details</p>
    <?php 
    if(!$conn){
        die("cannot connect");
    }
    else{
      $query="Select * from record where sno='".$_SESSION['sno']."';";
      $result=mysqli_query($conn,$query);
      $res= mysqli_fetch_assoc($result);
      ?>
      <div class="container2">
        <div class="sec">
          <img src="icon/icon1.avif" style="height:100px;
    width:100px;"/>
          <p class="heading">Factory Name is</p>
          <p class="textdata"> <?php echo $res['fname']?></p>
        </div>
        <div class="sec">
        <img src="icon/outleticon.jpg" style="height:100px;
    width:100px;"/>
          <p class="heading">Total <br>outlets is</p>
          <p class="textdata"><?php echo $res['toutlets']?></p>
        </div>
        <div class="sec">
        <img src="icon/serialicon.jpg" style="height:100px;
    width:100px;"/>
          <p class="heading">Your Serial no. is</p>
          <p class="textdata"><?php echo $res['sno']?></p>
        </div>
        <div class="sec">
        <img src="icon/emailicon.png" style="height:100px;
    width:100px;"/>
          <p class="heading">Your Email is</p>
          <p class="textdata" style="font-size:28px"><?php echo $res['email']?></p>
        </div>
        <div class="sec">
        <img src="icon/addressicon copy.png" style="height:100px;
    width:100px;"/>
          <p class="heading">Your Address is</p>
          <p class="textdata" style="font-size:28px"><?php echo $res['address']?></p>
        </div>
      </div>
      <?php
    }
    ?>
</body>
</html>