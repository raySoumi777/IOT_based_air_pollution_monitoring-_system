<?php 
    include("config.php");
    session_start();
    if(!isset($_SESSION['userid'])){
        header("Location: login.php");
    }
?>
<?php
//Include required phpmailer files
require 'includes/PHPMailer.php';
require 'includes/Exception.php';
require 'includes/SMTP.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                    <button name="company" value="<?= $res1['sno'] ?>" formaction="company.php" formmethod="post"><?= $res1['fname']?></button><br>
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
                    <button name="company" value="<?= $res1['sno'] ?>" formaction="companytable.php" formmethod="post"><?= $res1['fname']?> Table</button><br>
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
                    <button name="company" value="<?= $res1['sno'] ?>" formaction="companygraph.php" formmethod="post"><?= $res1['fname']?> graph</button><br>
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
            <form action="#" method="post">
                <button name="Logout" style="background-color:black; color:white; font-size:20px; border-radius:5px">Logout</button>
            </form>
        </div>
        <div class="adminbody">
            <center>
            <h1>These are the Companies who pollutes more</h1>
            <div class="adminmain">
                <?php
                $a=array("");
                $query1="select sno from account";
                $result1=mysqli_query($conn,$query1);
                $n1=mysqli_num_rows($result1);
                for($i=0;$i<$n1;$i++){
                    $res1=mysqli_fetch_assoc($result1);
                    $query2="select remarks from ".$res1['sno']."week";
                    $result2=mysqli_query($conn,$query2);
                    $n2=mysqli_num_rows($result2);
                    $count=0;
                    for($j=0;$j<$n2;$j++){
                        $res2=mysqli_fetch_assoc($result2);
                        if($res2['remarks']=="warning"){
                            $count++;
                        }
                    }
                    // echo $count."of".$res1['sno'];
                    if($count>2){
                        $show="Select * from record where sno='".$res1['sno']."';";
                        $output=mysqli_query($conn,$show);
                        $out= mysqli_fetch_assoc($output);
                        $key1="complain".$out['sno'];
                        $key2="get".$out['sno'];
                        array_push($a,$res1['sno']);
                        // var_dump($a);
                        // echo $show
                        ?>
                        <form action="#" method="post">
                        <div class="data">
                            <h1><?= $out['fname'] ?></h1>
                            <input type="hidden" name=<?= $key2?> value=<?= $out['email'] ?>/>
                            <button name=<?= $key1?> > Complain</button>
                        </div>
                    </form>
                        <?php
                    }
                }
                ?>
                </div>
                </center>
        </div>
    </div>
</div>

</body>
<?php
    
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['Logout'])){
        unset($_SESSION['userid']);
        session_destroy();
        header("Location: login.php");
    }
    for($i=0;$i<count($a);$i++){
         $key_search="complain".$a[$i];
         $key_get="get".$a[$i];
        if(isset($_POST[$key_search])){
            $to=$_POST[$key_get];
            $c=$to[0];
            for($i=1;$i<strlen($to)-1;$i++){
                $c=$c.$to[$i];
            }
            //echo $c;
    
    //Create instance of phpmailer
        $mail = new PHPMailer();
    //set mailer to use smtp
        $mail->isSMTP();
    //define smtp host
        $mail->Host="smtp.gmail.com";
    //enable smtp authentication
        $mail->SMTPAuth = "true";
    //set type of encryption (ssl/tls)
        $mail->SMTPSecure ="tls";
    //set port to connect smtp
        $mail->Port="587";
    //set gmail username
        $mail->Username="bagasmita25@gmail.com";
    //set gmail password
        $mail->Password="kuplwnjgwesdzede";
    //set email subject
        $mail->Subject="Emission is large";
    //set semder email
        $mail->setFrom("bagasmita25@gmail.com");
    //email body
        $mail->Body="You should look after your emission unless we have to take definite action";
    //add resipient
        $mail->addAddress($c);
    //finally send email
        if($mail->send()){
            //echo "Email sent";
            ?>
             <script>alert("Messege sent successfully")</script>
            <?php
        }
        else{
           //echo "Error";
           ?>
             <script>alert("Messege not sent")</script>
            <?php
        }
    //closing smtp connection
        $mail->smtpClose();
        }
    }
}
?>
</html>