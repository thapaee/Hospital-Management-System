<?php
session_start();

if(time()-$_SESSION["tim"]>60){
    
    echo "<script>alert('Session timed out');";
    echo "window.location.href='logout.php';</script>";
    
}
else{
   $_SESSION["tim"]=time();

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
.docno{
  margin-left:18%;
  background-color:rgb(255,255,240);
  width:250px;
  height:200px;
  margin-top: 2%;
  float:left;
  display:inline-block;

  box-shadow:0px 10px 10px gray;
}
.patientno{
  margin-left:5%;
  background-color:white;
  width:250px;
  height:200px;
  margin-top: 2%;
  float:left;
  display:block;
  box-shadow:0px 10px 10px gray;
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
.patienttable{
  margin-left:2%;
  background-color: white;
  width: 500px;
  height: 300px;
  margin-top: 2%;
  float:left;
  display:inline-block;
  box-shadow:0px 10px 10px gray;

}
.count{
    text-align:center;
    font-size:50px;
    font-weight:bolder;

}
table{
  width:100%;
}
</style>
</head>
<body>

<div class="navigation">
  <div class="round">
  </div>
    <a href="dash.php"><button style="background-color:black;color:white;">Overview</button></a>
    <a href="admin_doctor.php"><button>Doctor</button></a>
    <a href="admin_patient.php"><button>Patient</button></a>
    <a href="admin_notice.php"><button>Notice</button></a>
    <a href="logout.php"><button>Sign Out</button></a>
</div>

<div class="top"><center><h2>Welcore on board!!</h2></center><hr></div>

<div class="docno">
<center><h4>No. of doctors</h4></center><hr>
<?php
$conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}

$h=mysqli_query($conn,"Select * from doctor;");
$r=mysqli_num_rows($h);
echo "<p class='count'>".$r."</p>";
?>
</div>
<div class="patientno"><center><h4>No. of patients</h4></center><hr>
<?php
$conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}

$h=mysqli_query($conn,"Select * from patient;");
$r=mysqli_num_rows($h);
echo "<p class='count'>".$r."</p>";
?>

</div>

<div class="doctable">

<?php
$conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}

$h=mysqli_query($conn,"Select * from doctor order by Date desc;");
$r=mysqli_num_rows($h);
if($r>0){
   echo "<table><tr><td colspan=4 style='background-color:powderblue;'><center><h4>Doctors</h4></center></td></tr>";
  echo "<tr><td>S.No.</td><td>Doctor name</td><td>Department</td><td>Mobile</td></tr>";
   $count=0;
   while($row=mysqli_fetch_assoc($h)){
       echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Name"]. "</td><td> " . $row["Department"]. "</td><td>".$row["phone"]."</td></tr>";
       $count = $count+1;
       if($count==5){
        break;
}
}

}
echo "</table>";

?>



</div>
<div class="patienttable">
<?php
$conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}

$h=mysqli_query($conn,"Select * from patient order by Date desc;");
$r=mysqli_num_rows($h);
if($r>0){
   echo "<table><tr><td colspan=4 style='background-color:powderblue;'><center><h4>Patients</h4></center></td></tr>";
  echo "<tr><td>S.No.</td><td>Patient name</td><td>email</td><td>Mobile</td></tr>";
   $count=0;
   while($row=mysqli_fetch_assoc($h)){
       echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Name"]. "</td><td> " . $row["email"]. "</td><td>".$row["phone"]."</tr>";
       $count = $count+1;
       if($count==5){
        break;
}
}

}
echo "</table>";

?>

</div>
</body>
</html>
