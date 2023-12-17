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
   float:right;
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
    <a href="patient_dash.php"><button>Overview</button></a>
    <a href="patient_booking.php"><button>Book ticket</button></a>
    <a href="patient_report.php"><button style="background-color:black;color:white;">Check Report</button></a>
    <a href="patient_notice.php"><button>Check Notice</button></a>
    <a href="patient_news.php"><button>News</button></a>
    <a href="logout.php"><button>Sign Out</button></a>
</div>

<div class="top"><center><h2>Reports</h2></center><hr></div>
<?php
 $conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}

$h=mysqli_query($conn,"Select * from reports where patient_id= ".$_SESSION['id']." order by Date desc;");
$r=mysqli_num_rows($h);
if($r>0){
   while($row=mysqli_fetch_assoc($h)){
       $row2=mysqli_fetch_assoc(mysqli_query($conn,"Select * from doctor where ID= ".$row['doc_id'].";"));
       echo "<div class='notice-present'>".$row["Date"]."<hr><u>Checked by:</u>Dr.".$row2['Name']."<br><u><p>Symptoms:</u> ".$row["Symptoms"]."</p><u>Medications:</u>".$row["Medication"]."</p></div>";
        
}
}
else{
   echo "<div class='notice-box'>No  reports Available</div>";
}


?>