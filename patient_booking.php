<?php
session_start();
if(time()-$_SESSION["tim"]>60){
    
    echo "<script>alert('Session timed out');";
    echo "window.location.href='logout.php';</script>";
    
}
else{
   $_SESSION["tim"]=time();

}

if(isset($_POST['id'])){
   $conn=mysqli_connect("localhost","root","","testdb");
   if(!$conn){
      die("failed");
   }
   $h=mysqli_query($conn,"Insert into booked values(".$_SESSION['id'].",".$_POST['id'].");");


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
  background-image: url('doctor.jpg');
}
.big{
   margin-left:18%;

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
    <a href="patient_dash.php"><button>Overview</button></a>
    <a href="patient_booking.php"><button style="background-color:black;color:white;">Book ticket</button></a>
    <a href="patient_report.php"><button>Check Report</button></a>
    <a href="patient_notice.php"><button>Check Notice</button></a>
    <a href="patient_news.php"><button>News</button></a>
    <a href="logout.php"><button>Sign Out</button></a>
</div>

<div class="top"><center><h2>
<?php
if($_SESSION["Name"]){
echo "Welcore on board ".$_SESSION["Name"]."!!";
}
else{
 echo "Welcome";

}
?>
</h2></center><hr></div>
<div class="big">

<?php
$conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}
$h=mysqli_query($conn,"Select * from booked where patient_id= ".$_SESSION['id']." ;");
$r=mysqli_num_rows($h);
if($r>0){
  echo "You already have a booking";
  $row=mysqli_fetch_assoc($h);
  $h=mysqli_query($conn,"Select * from doctor where ID=".$row['doc_id'].";");
  $row=mysqli_fetch_assoc($h);
  echo "Doctor name: ".$row['Name'];
}
else{
$h=mysqli_query($conn,"Select * from doctor;");
$r=mysqli_num_rows($h);
if($r>0){
   echo "<table><tr><td colspan=5 style='background-color:powderblue;'><center><h4>Doctors</h4></center></td></tr>";
  echo "<tr><td>ID</td><td>Doctor name</td><td>Department</td><td>Mobile</td><td>Action</td></tr>";

   while($row=mysqli_fetch_assoc($h)){
       echo "<tr><td>" . $row["ID"]. "</td>";
       echo "<td>" . $row["Name"]. "</td>";
       echo "<td> " . $row["Department"]. "</td>";
       echo "<td>".$row["phone"]."</td>";
       echo "<td><form action='patient_booking.php' method='POST'><input type='hidden' name='id' value=".$row["ID"].">";
       echo "<input type='submit' value='Book'></form></td>";
       echo "</tr>";

}

}
echo "</table>";
}
?>

</div>
