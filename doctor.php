<?php
session_start();
$message="";
if(count($_POST)>0) {
 $con = mysqli_connect('localhost','root','','testdb') or die('Unable To connect');
 $result = mysqli_query($con,"SELECT * FROM doctor WHERE email='" . $_POST["username"]. "' and password='".$_POST['pwd']."';"); 
 $row  = mysqli_fetch_array($result);
 if(is_array($row)) {
     $_SESSION["id"] = $row['ID'];
     $_SESSION["Name"] = $row['Name'];
     $_SESSION["mail"] = $row['email'];
     $_SESSION['tim']=time();
  } else {
      $message = "Invalid Username or Password!";
 }
 }
 if(isset($_SESSION["id"])) {
      header("Location:doctor_dash.php");
  }
?>
<html>
<head>
<style>
body{
   margin:0px;
   background : linear-gradient(to bottom, #33ccff 0%, #ff99cc 100%);
}
.container{
     padding:10px;
     position:fixed;
     top:50%;
     left:50%;    
     transform: translate(-50%,-50%);
     width:200px;
     box-shadow:10px 15px 135px ;
     background-color:white;
     border-radius:5%;
}
.message{
    color:red;
}
.form-group{
     margin-bottom:1em;
}
.form-label{
   display:block;
   transform:translateY(-1.25em);
   transform-origin:0 0;
   transition:all .3s;
}
.form-control{
 width:100%;
 height:2em;
 border-style:none none solid none;
 
 transition:all .5s;
 
}
.form-control::placeholder{
   color:transparent;
}
.form-control:focus{
      outline:none;
      box-shadow:none;
      border-color:orange;
}
.form-control:focus + .form-label,
.form-control:not(:placeholder-shown) + .form-label
{
      transform:translateY(-2.25em);
}
h1{
  color:black;
}
.form-submit{
    background-image: linear-gradient(to bottom, #33ccff 0%, #ff99cc 100%);
    width:100%;
    radius:5%;
    height:2em;
    border:none;
    font-size:1em;
    font-weight:bold;
    color:white;
}
</style>
</head>
<body>
<div class="container">
<h1><center>Login</center></h1>
<div class="message"><?php if($message!="") { echo $message; } ?></div>
<form action="doctor.php" method="POST" class="form" autocomplete="off">
   <div class="form-group">
   <input type="text" name="username" class="form-control" placeholder="name">
   <label class="form-label">username</label>
   </div>
   <div>
   <input type="password" name="pwd" class="form-control" placeholder="password">
   <label class="form-label">password</label>
   </div>
   <input type="submit" name="submit" value="Log in" class="form-submit">
</form>
<div>
<a href="signup_doctor.html">Are you a new doctor??</a>
</div>
</div>

</body>
</html>