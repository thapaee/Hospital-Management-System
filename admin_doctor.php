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

$h=mysqli_query($conn,"Delete from doctor where ID=".$_POST["id"].";");


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
</style>
</head>
<body>

<div class="navigation">
  <div class="round">
  </div>
    <a href="dash.php"><button>Overview</button></a>
    <a href="admin_doctor.php"><button style="background-color:black;color:white;">Doctor</button></a>
    <a href="admin_patient.php"><button>Patient</button></a>
    <a href="admin_notice.php"><button>Notice</button></a>
    <a href="logout.php"><button>Sign Out</button></a>
</div>

<div class="top"><center><h2>View/Remove doctors</h2></center><hr></div>
<div class="big">

<?php
$conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}

$h=mysqli_query($conn,"Select * from doctor;");
$r=mysqli_num_rows($h);
if($r>0){
   echo "<table><tr><td colspan=5 style='background-color:powderblue;'><center><h4>Doctors</h4></center></td></tr>";
  echo "<tr><td>S.No.</td><td>Doctor name</td><td>Department</td><td>Mobile</td><td>Action</td></tr>";

   while($row=mysqli_fetch_assoc($h)){
       echo "<tr><td>" . $row["ID"]. "</td>";
       echo "<td>" . $row["Name"]. "</td>";
       echo "<td> " . $row["Department"]. "</td>";
       echo "<td>".$row["phone"]."</td>";
       echo "<td><form action='admin_doctor.php' method='POST'><input type='hidden' name='id' value=".$row["ID"].">";
       echo "<input type='submit' value='delete'></form></td>";
       echo "</tr>";

}

}
echo "</table>";

?>


</div>
