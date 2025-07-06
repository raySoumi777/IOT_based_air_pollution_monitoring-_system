<?php 
    include("config.php");
    session_start();
    if(!isset($_SESSION['userid'])){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="profile1.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
<script>
        function myFunction(element){
            if(element.style.display==="none"){
                 element.style.display="block";
            }
            else{
                element.style.display="none";
            }
            //   element.style.display="block";
            
        }
    </script>
    <div class="container">
    <div class="sidebar">
        <div class="adminimg">
            <img src="icon/adminimg.png" style="height:100px;width:150px;">
            <h1>Admin</h1>
        </div>
        <div class="option">
        <form>
            <button name="dashboard" value="dashboard" formaction="admin.php" formmethod="post">Dashboard</button>
            <div name="company" class="company" onclick="myFunction(submenu1)">Company</div><br>
            <div id="submenu1">
                <?php
                $query1="select sno,fname from record;";
                $result1=mysqli_query($conn,$query1);
                $n1=mysqli_num_rows($result1);
                for($i=0;$i<$n1;$i++){
                    $res1=mysqli_fetch_assoc($result1);
                    ?>
                    <button name="company" value="<?= $res1['sno'] ?>" formaction="company.php" formmethod="post"><?= $res1['fname']?></button>
                    <?php
                }
                ?>
            </div>    
            <div name="table" class="table" onclick="myFunction(submenu2)">Table</div><br>
            <div id="submenu2">
                <?php
                $query1="select sno,fname from record;";
                $result1=mysqli_query($conn,$query1);
                $n1=mysqli_num_rows($result1);
                for($i=0;$i<$n1;$i++){
                    $res1=mysqli_fetch_assoc($result1);
                    ?>
                    <button name="company" value="<?= $res1['sno'] ?>" formaction="companytable.php" formmethod="post"><?= $res1['fname']?> Table</button>
                    <?php
                }
                ?>
            </div> 
            <div name="graph" class="graph" onclick="myFunction(submenu3)">Graph</div>
            <div id="submenu3">
                <?php
                $query1="select sno,fname from record;";
                $result1=mysqli_query($conn,$query1);
                $n1=mysqli_num_rows($result1);
                for($i=0;$i<$n1;$i++){
                    $res1=mysqli_fetch_assoc($result1);
                    ?>
                    <button name="company" value="<?= $res1['sno'] ?>" formaction="companygraph.php" formmethod="post"><?= $res1['fname']?> graph</button>
                    <?php
                }
                ?>
            </div> 
        </form>
        </div>
    </div>
    <div class="adminpage">
        <div class="horizontalbar">
            <h1>ADMIN PAGE</h1>
        </div>
        <div class="adminbody">
        <h1 class="heading" style="text-align:center; font-size:56px;">This is the Profile</h1>
    <p style="text-align:center;">This page contains all details of the company</p>
    <?php 
    if(!$conn){
        die("cannot connect");
    }
    else{
      $query="Select * from record where sno='".$_POST['company']."';";
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
        </div>
    </div>
</div>
</body>
</html>