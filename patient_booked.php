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

</style>
</head>
<body>

<div class="navigation">
  <div class="round">
  </div>
    <button><a href="doctor_dash.php">Overview</a></button>
    <button><a href="patient_booking.php">Book ticket</a></button>
    <button><a href="patient_report.php">Check Report</a></button>
    <button><a href="patient_notice.php">Check Notice</a></button>
    <button><a href="logout.php">Sign Out</a></button>
</div>

<div class="top"><center><h2>
<?php 
if($_SESSION["Name"]){ 
echo "Welcore on board".$_SESSION["Name"]."!!";
} 
?>
</h2></center><hr></div>
<div class="big">

</div>