<?php
session_start();

include "otp_function.php";
$otp=rand(1000,9999);
$_SESSION['otp']=$otp;
$_SESSION['email']=$_POST['email'];
//send_otp($_POST['email'],$otp);
$conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}
$h=mysqli_query($conn,"Insert into unverified values('".$_POST['username']."','".$_POST['email']."','".$_POST['pwd']."', ".$otp.",".$_POST['phone'].");");
mysqli_close($conn);
header("Location: otp_authenticate.php");

?>