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
    <h1>Day Graph</h1>
    <div class="w-full flex justify-center items-center">
        <div style="height:600px;width:1000px">
            <canvas id="pollutionChart"></canvas>
        </div>
    </div><br>
    <h1>week Graph</h1>
    <div class="w-full flex justify-center items-center">
        <div style="height:600px;width:1000px">
            <canvas id="pollutionChartweek"></canvas>
        </div>
    </div>
    </center>
        </div>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
    $sid=$_POST['company'];
    $sql = "SELECT gasvalue,gasname FROM ".$sid."day ORDER BY gasname DESC LIMIT 10";
    $result = mysqli_query($conn, $sql);

    $sql2 = "SELECT week_day,gasavgvalue FROM ".$sid."week ORDER BY week_day DESC LIMIT 10";
     $result2 = mysqli_query($conn, $sql2);
    
    // loop through the result set and store the data in arrays
    $value_data = array();
    $gasname_data = array();

    $value_data2 = array();
    $day = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        $value_data[] = $row['gasvalue'];
        $gasname_data[] = $row['gasname'];
    }

    while ($row2 = mysqli_fetch_assoc($result2)) {
        $value_data2[] = $row2['gasavgvalue'];
        $day[] = $row2['week_day'];
    }

    // reverse the arrays to show the data in chronological order
    $value_data = array_reverse($value_data);
    $gasname_data = array_reverse($gasname_data);

    $value_data2 = array_reverse($value_data2);
    $day = array_reverse($day);
?>

<script>
        var ctx = document.getElementById('pollutionChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($gasname_data); ?>,
                datasets: [{
                    label: 'pollution',
                    data: <?php echo json_encode($value_data); ?>,
                    fill: false,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Pollution Level'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Gas Name'
                        }
                    }
                }
            }
        });


        var ctx = document.getElementById('pollutionChartweek').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($day); ?>,
                datasets: [{
                    label: 'pollution',
                    data: <?php echo json_encode($value_data2); ?>,
                    fill: false,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Pollution Level'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Day'
                        }
                    }
                }
            }
        });
    </script>
</html>