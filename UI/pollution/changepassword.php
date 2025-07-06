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
    <title>Chane Password</title>
    <link rel="stylesheet" type="text/css" href="password.css">
</head>
<body>
    <div class="password"> 
    <center>
    <h2>Reset Password Form</h2>
    <div class="container">
    <div class="changepswbody">
        <form action="#" method="post">
    <table>
        <tr><td>Follow the process to change the password</td></tr>
        <tr><td><input type="password" name="newpassword" placeholder="New Password"/></td></tr>
        <tr><td><input type="password" name="confirmpassword" placeholder="Confirm Password"/></td></tr>
        <tr><td><button type="submit" name="submitdata">Submit</button></td></tr>
    </table>
</form>
    </div>

</div>
</center>
</div>

<?php
if(!$conn){
    die("cannot connect");
}
else{
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['submitdata'])){
            if($_POST['newpassword']==$_POST['confirmpassword']){
                $query="update record set psw ='".$_POST['newpassword']."' where sno='".$_SESSION['sno']."';";
                mysqli_query($conn,$query);
                ?>
                    <script> alert("Password Change Successfully")</script>
                    <?php
                    header("Location: detail.php");
            }
            else{
                ?>
                <script> alert("Please Check Your Password")</script>
                <?php
            }
        }
    }
}

?>
</body>
</html>