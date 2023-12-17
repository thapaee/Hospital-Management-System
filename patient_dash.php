<?php
session_start();
if(time()-$_SESSION["tim"]>60){
    
    echo "<script>alert('Session timed out');";
    echo "window.location.href='logout.php';</script>";
    
}
else{
   $_SESSION["tim"]=time();

}
if(isset($_POST['cancel'])){
   $conn=mysqli_connect("localhost","root","","testdb");
            if(!$conn){
                die("failed");
               }

   $t=mysqli_query($conn,"Delete from booked where patient_id= ".$_SESSION['id']." and doc_id= ".$_POST['cancel']." ;");
  // echo "<script>window.alert('Appointment cancelled sucessfully')</script>";

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
  background-color:white;
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
.cancel{
   border:none;
   float:right;
   background-color:powderblue;
}

</style>
</head>
<body>

<div class="navigation">
  <div class="round">
  </div>
    <a href="patient_dash.php"><button style="background-color:black;color:white;">Overview</button></a>
    <a href="patient_booking.php"><button>Book ticket</button></a>
    <a href="patient_report.php"><button>Check Report</button></a>
    <a href="patient_notice.php"><button>Check Notice</button></a>
    <a href="patient_news.php"><button>News</button></a>
    <a href="logout.php"><button>Sign Out</button></a>
</div>

<div class="top"><center><h2>
<?php
if($_SESSION["Name"]){
echo "Welcore on board ".$_SESSION['Name']."!!";
}
?>
</h2></center><hr></div>
<div>
<div class="check_status">
<center><h2 style="background-color:powderblue;margin:0;padding:0;"> Appointment status<hr></h2></center>
<?php
$conn=mysqli_connect("localhost","root","","testdb");
            if(!$conn){
                die("failed");
               }

   $t=mysqli_query($conn,"Select * from booked where patient_id= ".$_SESSION['id'].";");
   $r=mysqli_num_rows($t);
   if($r>0){
   $row = mysqli_fetch_assoc($t);
   $row= mysqli_fetch_assoc(mysqli_query($conn,"Select * from doctor where ID= ".$row['doc_id'].";"));
   echo "Booked with Doctor: ".$row['Name']."<br> Speciality: ".$row['Department']."<br>Contact info: <br>E-mail: ".$row['email']."<br>Phone No.: ".$row['phone'];
   echo "<br><br><form action='patient_dash.php' method='POST'><button class='cancel' name='cancel' value=".$row['ID'].">Cancel</button>";
}
   else{
    echo $_SESSION['Name']." No booking found<br>Head to book ticket ";
}
?>
</div>
<div class="emergency">
<center><h2 style="background-color:red;margin:0;padding:0;color:white;"> Emergency<hr></h2></center>
<button style="width:300px;height:70%;font-size:30px;color:red;" onclick="emergency()">Click Here</button>
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
<script>
function emergency(){
  window.alert("We will send an ambulance to your location as soon as possible");
}
</script>
</body>
</html>
