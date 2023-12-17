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
td{
  font-weight:bold;
  font-size:30px;
  display:inline;
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
<table>
<?php
$conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}
$h=mysqli_query($conn,"Select * from patient where ID=".$_POST['idd']);
$row=mysqli_fetch_assoc($h);
echo "<tr><td>Patient name: </td><td>".$row['Name']."</td></tr>";
?>
<form action="pass.php" method="POST">

<tr>
<td>
<label>Symptoms&nbsp;&nbsp;</label>
</td><td>
<textarea name="symptoms" rows=10 cols=30></textarea>
</td>

</tr>
<tr>
<td>
<label>Medication&nbsp;</label>
</td>
<td>
<textarea name="Medication" rows=10 cols=30></textarea>
</td></tr></table><input type="submit" value="submit"  style="font-size:25px;">
<input type="hidden" value="<?php echo $row['ID']; ?>" name="patient_id">
</form>