<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
    
</head>

<body class="Registerbody">
    <form action="#" method="post" class="form">
        <div class="container">
            <div class="regsideimg"></div>
            <div class="register">
                <div class="heading">
                    <p>Register</p>
                </div>
                <div class="input">
                    Enter the Factory name:
                    <br><input type="text" name="fname"><br>
                    Enter the total outlets:<br><input type="number" name="outlets" required><br>
                    Enter the Pan no.:<br><input type="text" name="panno" required><br>
                    Enter the serial no.:<br><input type="number" name="serialno" required><br>
                    Enter the Email.:<br><input type="email" name="mail" required><br>
                    Enter the Address:<br><input type="text" name="address" required><br>
                    Enter the Police Station:<br><input type="text" name="psname" required><br>
                    Enter the Password no.:<br><input type="password" name="psw" required><br>
                    <button type="submit" name="datasubmit">Submit</button>
                </div>
            </div>
        </div>
    </form>

    <?php
    if(!$conn){
        die("cannot connect");
    }
    else{
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(isset($_POST['datasubmit'])){
                $query="insert into record values('".$_POST['fname']."',".$_POST['outlets'].",'".$_POST['panno']."',".$_POST['serialno'].",'".$_POST['mail']."','".$_POST['address']."','".$_POST['psname']."','".$_POST['psw']."');";
                //insert into record values('hello',34,'fb367',2,'bah@gmail.com','1/2','hello','145');
                $result=mysqli_query($conn,$query);
                //echo $result;
            }
        }
    }
    ?>
</body>

</html>