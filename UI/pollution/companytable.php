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
    <link rel="stylesheet" type="text/css" href="admin.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #FFB454  ;
        }
    </style>
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
        <center>
    <h1>Day Table</h1>
    </center>
    <?php
        $query="Select * from ".$_POST['company']."day;";
        $query2="Select * from ".$_POST['company']."week;";
        try{
            $result=mysqli_query($conn,$query);
            $n=mysqli_num_rows($result);

            $result2=mysqli_query($conn,$query2);
            $n2=mysqli_num_rows($result2);
            ?>
                <table>
                    <tr>
                        <th>Gas Name</th>
                        <th>Gas Value</th>
                        <th>Remarks</th>
                    </tr>
                    <?php
                    for($i=0;$i<$n;$i++){
                        $res=mysqli_fetch_assoc($result);
                        ?>
                        <tr>
                        <td><?php echo $res['gasname'] ?></td>
                        <td><?php echo $res['gasvalue'] ?></td>
                        <td><?php echo $res['remarks'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>                   
                </table>
                <br><center>
                <h1>Weekly table</h1>
                </center>
                <table>
                    <tr>
                        <th>Day</th>
                        <th>Gas Value</th>
                        <th>Remarks</th>
                    </tr>
                    <?php
                    for($i=0;$i<$n2;$i++){
                        $res2=mysqli_fetch_assoc($result2);
                        ?>
                        <tr>
                        <td><?php echo $res2['week_day'] ?></td>
                        <td><?php echo $res2['gasavgvalue'] ?></td>
                        <td><?php echo $res2['remarks'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>                   
                </table>
            <?php
        }
        catch(Exception $e){
            ?>
            <script>alert("There is no table")</script>
            <?php
            // header("Location: detail.php");
        }
    ?>
        </div>
    </div>
</div>
</body>
</html>