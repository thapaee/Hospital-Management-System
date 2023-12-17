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
   $patient_id=$_POST['id'];
   $doc_id=$_SESSION['id'];
   $conn=mysqli_connect("localhost","root","","testdb");
   if(!$conn){
     die("failed");
   }
   
   $t=mysqli_query($conn,"Delete from booked where patient_id = ".$patient_id." and doc_id = ".$doc_id.";");
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
    <a href="doctor_dash.php"><button>Overview</button></a>
    <a href="doctor_booking.php"><button style="background-color:black;color:white;">Check Bookings</button></a>
    <a href="doctor_report.php"><button>View Reports</button></a>
    <a href="doctor_notice.php"><button>Check Notice</button></a>
    <a href="logout.php"><button>Sign Out</button></a>
</div>

<div class="top"><center><h2>
<?php 
if($_SESSION["Name"]){ 
echo "Welcore on board Dr.".$_SESSION["Name"]."!!";
} 
?>
</h2></center><hr></div>
<div class="big">
<?php
$conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}
$h=mysqli_query($conn,"Select * from booked where doc_id=".$_SESSION['id'].";");
$r=mysqli_num_rows($h);
if($r>0){
     echo "<table><tr><td colspan=5 style='background-color:powderblue;'><center><h4>Patient list</h4></center></td></tr>";
     echo "<tr><td>Id</td><td>Patient name</td><td>Generate report</td><td>Mobile</td><td>Action</td></tr>";

     while($row=mysqli_fetch_assoc($h)){
        $h2=mysqli_query($conn,"Select * from patient where Id=".$row['patient_id'].";"); 
        $row2=mysqli_fetch_assoc($h2);      
        echo "<tr><td>".$row2['ID']."</td>";
        echo "<td>" . $row2["Name"]. "</td>";
        echo "<td><form action='generate_report.php' method='POST'><input type='hidden' name='idd' value=".$row2["ID"]."><input type='submit' value='Generate'></form></td>";
       echo "<td>".$row2["phone"]."</td>";
       echo "<td><form action='doctor_booking.php' method='POST'><input type='hidden' name='id' value=".$row2["ID"].">";
       echo "<input type='submit' value='Done'></form></td>";
       echo "</tr>";
      }

      echo "</table>";
}
else
{
echo "<h1>You don't have any bookings !!</h1>";
}

?>
</div>