<?php
   session_start();
if(time()-$_SESSION["tim"]>60){
    
    echo "<script>alert('Session timed out');";
    echo "window.location.href='logout.php';</script>";
    
}
else{
   $_SESSION["tim"]=time();

}
   if(isset($_POST["notice"])){
        $conn= mysqli_connect ("localhost","root","","testdb");
   if(!$conn){
   die("failed");
         }
    echo $_POST["notice"].date('yy-m-d h:i:s');
   $query="Insert into notice(Notice,Date) values('".$_POST["notice"]."','".date('yy-m-d h:i:s')."');";
   echo $query;
   $t=mysqli_query($conn,$query);
   if($t){
       header("Location:admin_notice.php");
     }
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
.take-entry{
      margin-left:18%;
}
.in{
   resize:both;
   width:500px;
   height:400px;
   margin:50px;
  
}
h1{
  margin-left:18%;
}
</style>
</head>
<body>

<div class="navigation">
  <div class="round">
  </div>
    <a href="dash.php"><button>Overview</button></a>
    <a href="admin_doctor.php"><button>Doctor</button></a>
    <a href="admin_patient.php"><button>Patient</button></a>
    <a href="admin_notice.php"><button style="background-color:black;color:white;">Notice</button></a>
    <a href="logout.php"><button>Sign Out</button></a>
</div>

<div class="top"><center><h2>NoticeBoard</h2></center><hr></div>
<h1> Type the notice below</h1>
<div class="take-entry">
<form action="post_notice.php" method="post">
<textarea placeholder="Notice here" name="notice" class="in">
</textarea>
<br>
<input type="submit" value="Post Notice" >
</form>
</div>