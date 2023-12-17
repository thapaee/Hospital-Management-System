<?php
session_start();

if(isset($_POST['otp'])){
   if($_POST['otp']==$_SESSION['otp']){
            $conn=mysqli_connect("localhost","root","","testdb");
            if(!$conn){
                die("failed");
               }
            unset($_SESSION['otp']);
            $mail=$_SESSION['email'];
            $h=mysqli_query($conn,"Select * from unverified where email='".$_SESSION['email']."';");
            $row=mysqli_fetch_assoc($h);
            $p=mysqli_query($conn,"Insert into patient(name,email,phone) values('".$row['Name']."','".$row['email']."',".$row['phone'].",'".date('yy-m-d h:i:s')."');");
            //mysqli_commit($conn);
            $i=mysqli_query($conn,"Select * from patient where email = '".$_SESSION['email']."' ;");
            $row=mysqli_fetch_assoc($i);
            echo $row['Name'];
            $_SESSION['id']=$row['ID'];
            $_SESSION['Name']=$row['Name'];
            
            $h=mysqli_query($conn,"Delete from unverified where email='".$_SESSION['email']."';");
            header("Location:patient_dash.php");    
}
else{
    $message="Invalid otp";
}

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
<h1><center>Verification</center></h1>
<h2>Please enter the otp sent to your email</h2>
<form action="otp_authenticate.php" method="POST" class="form" autocomplete="off">
   <div class="form-group">
   <input type="text" name="otp" class="form-control" placeholder="otp">
   <label class="form-label">ENTER OTP</label>
   </div>
   <input type="submit" name="submit" value="Verify" class="form-submit">
</form>
</div>
</body>
</html>

