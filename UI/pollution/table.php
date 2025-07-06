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
    <title>Document</title>
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
    <center>
    <h1>Day Graph</h1>
    </center>
    <?php
        $query="Select * from ".$_SESSION['sno']."day;";
        $query2="Select * from ".$_SESSION['sno']."week;";
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
                <h1>Weekly Graph</h1>
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
            <script>alert("Error in showing table")</script>
            <?php
            header("Location: detail.php");
        }
    ?>
</body>
</html>