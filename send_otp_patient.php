<?php
session_start();

include "otp_function.php";
$otp=rand(1000,9999);
$_SESSION['otp']=$otp;
if(!isset($_SESSION['retry'])){
$_SESSION['email']=$_POST['email'];
}

send_otp($_SESSION['email'],$otp);
$conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}
if(!isset($_SESSION['retry'])){
$h=mysqli_query($conn,"Insert into unverified values('".$_POST['username']."','".$_POST['email']."','".$_POST['pwd']."', ".$otp.",".$_POST['phone'].");");
}
$_SESSION["time_otp"]=time();
header("Location: otp_authenticate_patient.php");

?>