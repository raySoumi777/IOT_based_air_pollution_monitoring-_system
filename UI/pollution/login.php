<?php
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,k initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
    
</head>

<body class="loginbody">
    <div class="container">
        <form action="#" method="post">
            <div class="login">
                <div class="heading">
                    <p>Admin Login</p>
                </div>
                <div class="input">
                    Enter the Admin:<input type="text" name="userid" required><br>
                    Enter the Password no.:<input type="password" name="psw" required><br>
                    <button type="submit" name="loginadmin">Login</button><br>
                </div>
            </div>
        </form>
        <form action="#" method="post" class="logindata">
            <div class="login">
                <div class="heading">
                    <p>User Login</p>
                </div>
                <div class="input">
                    Enter the serial no.:<input type="text" name="serialno" required><br>
                    Enter the Password no.:<input type="password" name="psw" required><br>
                    <button type="submit" name="loginrec">Login</button><br>
                    Don't have an account?<a href="register.php" class="nodata">Register</a>
                </div>
            </div>
        </form>
    </div>
    <?php
    if(!$conn){
        die("cannot connect");
    }
    else{
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(isset($_POST['loginrec'])){
                $query="Select sno from record where sno='".$_POST['serialno']."' and psw='".$_POST['psw']."';";
                $result=mysqli_query($conn,$query);
                $res=0;
                $res= mysqli_fetch_assoc($result);
                if($res>0){
                    session_start();
                    $_SESSION['sno']=$res['sno'];;
                    header("Location: detail.php");
                }
                else{
                    //header("Location: login.php");
                    ?>
                    <script> alert("Password is incorrect")</script>
                    <?php
                }
            }
            if(isset($_POST['loginadmin'])){
                $useradmin="Test";
                $pswadmin="Test";
                if($_POST['userid']==$useradmin && $_POST['psw']==$pswadmin){
                    session_start();
                    $_SESSION['userid']="Test";
                    header("Location: admin.php");
                }
            }
        }
    }
    ?>

</body>

</html>