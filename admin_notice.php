<?php
session_start();
if(time()-$_SESSION["tim"]>60){
    
    echo "<script>alert('Session timed out');";
    echo "window.location.href='logout.php';</script>";
    
}
else{
   $_SESSION["tim"]=time();

}
 if(isset($_POST["id"])){
    $conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}

$h=mysqli_query($conn,"Delete from notice where ID=".$_POST["id"].";");

    
}


?>
<html>
<head>
<style>
body{
  margin:0;
  background-color: #c0c0c0;
}
.navigation{
width:15%;
height:100%;
position:fixed;
background-color:lightblue;
margin: 0;
}
.navigation button{
  width:100%;
  border:none;
  display:inline-block;
  padding:15px;
  background-color:lightblue;
  font-size: 20px;
  font-weight: bolder;

}
.navigation button:hover{
   background-color:black;
   color:white;
}
.top{
  margin-left:15%;
}

.round{
  width:200px;
  height:200px;
  border-radius: 50%;
  background-color: red;
  background-image: url('admin.png');
}
.doctable{
  clear:both;
  margin-left:18%;
  background-color: white;
  width: 500px;
  height: 300px;
  margin-top: 2%;
  float:left;
  display:inline-block;
  box-shadow:0px 10px 10px gray;
}

.big{
  margin-left:18%;
  margin-right:18%;
  box-shadow:0px 10px 10px gray; 
}
table{
  width:100%;
}
td{
  text-align:center;
}
a{
   text-decoration:none;

}
.remove{
 border:none;
 background-color:Red;
 
 position:relative;
}
.add-new{
   margin-left:18%;
}
.add-new button{
   display:inline-block;
   padding:5px;

}
.notice-box{
   clear:both;
   margin-left:18%;
}
.notice-present{
   clear:both;
   margin-left:18%;
   background-color:white;
   display:inline-block;
   padding:10px;
   width:600px;
   box-shadow:0px 10px 10px gray;
}
</style>
</head>
<body>

<div class="navigation">
  <div class="round">
  </div>
    <a href="dash.php"><button>Overview</button></a>
    <a href="admin_doctor.php"><button>Doctor</button></a>
    <a href="admin_patient.php"><button>Patient</button></a>
    <a href="admin_notice.php"><button style="background-color:black;color:white;">Notice</button></a>
    <a href="logout.php"><button>Sign Out</button></a>
</div>

<div class="top"><center><h2>NoticeBoard</h2></center><hr></div>

<div class="add-new">

<button onclick="location.href='post_notice.php';" style="font-size:30px;margin-bottom:1%">New Notice</button><br>
</div>
<?php
 $conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}

$h=mysqli_query($conn,"Select * from notice order by Date desc;");
$r=mysqli_num_rows($h);
if($r>0){
   while($row=mysqli_fetch_assoc($h)){
        echo "<div class='notice-present'>".$row["Date"]."<hr>".$row["Notice"];
        echo "<form action='admin_notice.php' method='POST'><input type='hidden' name='id' value=".$row["ID"]."><input type='submit' style='float:right;' class='remove' value='delete'></form></div>";

}
}
else{
   echo "<div class='notice-box'>No new notices</div>";
}


?>
</div>