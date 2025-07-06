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
    <title>DETAIL</title>
    <link rel="stylesheet" type="text/css" href="style3.css">
</head>
<body>
    <div class="dashboard">
        <h1 style="color:white;font-size: 48px;">DashBoard</h1>
        <div class="dasboardnavbar">
            <form method='post'>
                <a href="#"><button name="caccount">Create Account</button></a>
                <a href="#"><button name="cpassword">Change Password</button></a>
                <a href="#"><button name="logout">Logout</button></a>
            </form>
        </div>
    </div>
    <div class="dashboardbody">
        <form method="post">
        <div class="data">
            <img src="data3.png" style="height:400px"/>
            <button name="viewprofile">View Profile</button>
        </div>
        </form>
        <form method="post">
        <div class="data">
            <img src="data1.png" style="height:400px"/>
            <button name="viewgraph">View Graph</button>
        </div>
        </form>
        <form method="post">
        <div class="data">
            <img src="data2.png" style="height:400px"/>
            <button name="viewtable">View Table</button>
        </div>
        </form>
    </div>
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(isset($_POST['logout'])){
                unset($_SESSION['sno']);
                session_destroy();
                header("Location: index.php");
            }
            if(isset($_POST['viewgraph'])){
                header("Location: graph.php");
            }
            if(isset($_POST['caccount'])){
                $account="create table ".$_SESSION['sno']."day
                (
                SID varchar(5),
                gasname varchar(20),
                gasvalue varchar(10),
                remarks varchar(10)
                );";
                $account2="create table ".$_SESSION['sno']."week
                (
                SID varchar(5),
                week_day date,
                gasavgvalue varchar(10),
                remarks varchar(10)
                );";
                $query="Insert into account values('".$_SESSION['sno']."');";
                try{
                    mysqli_query($conn,$account);
                    mysqli_query($conn,$account2);
                    mysqli_query($conn,$query);
                    ?>
                    <script> alert("Your account has been created successfully")</script>
                    <?php
                }
                catch(Exception $e){
                    ?>
                    <script> alert("error in account creation or you have an account")</script>
                    <?php
                }
            }
            if(isset($_POST['cpassword'])){
                header("Location: changepassword.php");
            }
            if(isset($_POST['viewprofile'])){
                header("Location: profile.php");
            }
            if(isset($_POST['viewtable'])){
                header("Location: table.php");
            }
        }
    ?>
</body>
</html>