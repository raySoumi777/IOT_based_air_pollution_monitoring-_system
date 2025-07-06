<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
<style type="text/css" media="all">
    body{
    margin: 0%;
    padding: 0%;
    box-sizing: border-box;
}
.container{
    display: flex;
    height: 100%;
    width:100%;
}
.sidebar{
    background-color: blue;
    height: 700px;
    width: 300px;
    
}
.adminimg{
    background-color: aqua;
    display: flex;
    justify-content: space-around;
}
.horizontalbar{
    background-color: blue;
    position: fixed;
    width: 100%;
    height: 70px;
    color: white;
    z-index: 10;
}
button{
    outline:none !important;
    background: none !important;
}
button[name="dashboard"]  {
    outline:none !important;
    background: none !important;
    border-color: white;
    border-radius: 10px;
    width:250px;
    margin-top: 10px;
    margin-left: 20px;
}
.company {
    outline:none !important;
    background: none !important;
    border-color: white;
    border-radius: 10px;
    width:250px;
    margin-top: 10px;
    margin-left: 20px;
}
.table {
    outline:none !important;
    background: none !important;
    border-color: white;
    border-radius: 10px;
    width:250px;
    margin-top: 10px;
    margin-left: 20px;
}
.graph {
    outline:none !important;
    background: none !important;
    border-color: white;
    border-radius: 10px;
    width:250px;
    margin-top: 10px;
    margin-left: 20px;
}

.option button{
    font-size: 28px;
    padding: 10px;
}
.adminpage{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.adminbody{
    height: 1000px;
    width:  900px;
    margin-top: 100px;
}
/* #submenu1{
    display:none;
} */
/* .option ul{
    list-style: none;
}
.option ul li{
    width:120px;
    /* margin:15px; */
    /* padding:15px;
}
.option ul li a{
    text-decoration: none;
    color: white;
}
.option ul li a:hover{
    background-color: rgb(16, 16, 57);
}
.submenu{
    display:none;
}
.option button:hover .submenu{
    display: block;
    position: absolute;
    background-color: blue;
    margin-top:15px;
    margin-left: 15px;
}
.option button:hover .submenu ul{
    display:block;
    
} */
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
				<button name="company" value="s01" formaction="company.php" formmethod="post">fname1</button>
                <button name="company" value="s01" formaction="company.php" formmethod="post">fname1</button>
				<button name="company" value="s01" formaction="company.php" formmethod="post">fname1</button>
            </div>    
            <div name="table" class="table" onclick="myFunction(submenu2)">Table</div><br>
            <div id="submenu2">
                <button name="company" value="s01" formaction="company.php" formmethod="post">fname1</button>
                <button name="company" value="s01" formaction="company.php" formmethod="post">fname1</button>
				<button name="company" value="s01" formaction="company.php" formmethod="post">fname1</button>
            </div> 
            <div name="graph" class="graph" onclick="myFunction(submenu3)">Graph</div>
            <div id="submenu3">
                <button name="company" value="s01" formaction="company.php" formmethod="post">fname1</button>
                <button name="company" value="s01" formaction="company.php" formmethod="post">fname1</button>
				<button name="company" value="s01" formaction="company.php" formmethod="post">fname1</button>
            </div> 
        </form>
        </div>
    </div>
    <div class="adminpage">
        <div class="horizontalbar">
            <h1>ADMIN PAGE</h1>
        </div>
        <div class="adminbody">

        </div>
    </div>
</div>
</body>
</html>