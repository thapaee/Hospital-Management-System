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
.report-present,.report-absent{clear:both;
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
    <a href="doctor_dash.php"><button>Overview</button></a>
    <a href="doctor_booking.php"><button>Check Bookings</button></a>
    <a href="doctor_report.php"><button style="background-color:black;color:white;">View Reports</button></a>
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
<?php
 $conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}

$h=mysqli_query($conn,"Select * from reports where doc_id= ".$_SESSION['id']." order by Date desc;");
$r=mysqli_num_rows($h);
if($r>0){
   while($row=mysqli_fetch_assoc($h)){
       $row2=mysqli_fetch_assoc(mysqli_query($conn,"Select * from patient where ID= ".$row['patient_id'].";"));
        echo "<div class='report-present'>".$row["Date"]."<hr><u>Patient Name:</u>".$row2['Name']."<br><u><p>Symptoms:</u> ".$row["Symptoms"]."</p><u>Medications:</u>".$row["Medication"]."</p></div>";
        
}
}
else{
   echo "<div class='report-absent'><h2>No  reports Available</h2></div>";
}


?>