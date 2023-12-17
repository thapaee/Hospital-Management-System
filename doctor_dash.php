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
.check_status{
  margin-left:18%;
  background-color:white;
  width:300px;
  height:200px;
  margin-top:2%;
  float:left;
  display:inine-block;
  box-shadow:0px 10px 10px gray;
}
.emergency{
  display:block;
  margin-left:5%;
  background-color:black;
  color:white;
  width:300px;
  height:200px;
  margin-top: 2%;
  float:left;
  display:block;
  box-shadow:0px 10px 10px gray;
}
.latest-notice{
  clear:both;
  margin-top:2%;
  margin-left:18%;
  float:left;
  width:600px;
  height:250px;
  background-color:white;
  box-shadow:0px 10px 10px gray;

}
</style>
</head>
<body>

<div class="navigation">
  <div class="round">
  </div>
    <a href="doctor_dash.php"><button style="background-color:black;color:white;">Overview</button></a>
    <a href="doctor_booking.php"><button>Check Bookings</button></a>
    <a href="doctor_report.php"><button>View Reports</button></a>
    <a href="doctor_notice.php"><button>Check Notice</button></a>
    <a href="logout.php"><button>Sign Out</button></a>
</div>

<div class="top"><center><h2>
<?php
if($_SESSION["Name"]){
echo "Welcore on board Dr. ".$_SESSION["Name"]."!!";
}
?>
</h2></center><hr></div>
<div class="check_status">
<center><h2 style="background-color:powderblue;margin:0;padding:0;"> No. of appointments<hr></h2></center>
<?php
$conn=mysqli_connect("localhost","root","","testdb");
            if(!$conn){
                die("failed");
               }

   $t=mysqli_query($conn,"Select * from booked where doc_id= ".$_SESSION['id'].";");
   $r=mysqli_num_rows($t);
   if($r>0){
   echo "<center><b><p style='font-size:50px;'>".$r."</p></b></center>";
   }
   else{
    echo "Dr. ".$_SESSION['Name']." You don't have appointments today";
}
?>
</div>
<div class="emergency">
<p>For our dear doctors,<br><br> ABC Hospital would like to thank you for your contribution to this hospital in this difficult ties of the corona pandemic.<br><center> You are a True hero!!</center></p>
</div>
<div class="latest-notice">
<center><h2 style="background-color:powderblue;margin:0;padding:0;"> Latest Notice<hr></h2></center>
<?php
 $conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}

$h=mysqli_query($conn,"Select * from notice order by Date desc;");
$r=mysqli_num_rows($h);
if($r>0){
   $row=mysqli_fetch_assoc($h);
   echo "Date:".$row['Date']."<br>Posted by: ABC administration<br>".$row['Notice'];


}
else{
   echo "No new notices";
}


?>
</div>
</body>
</html>
