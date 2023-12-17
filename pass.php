<?php
session_start();
$conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}
$symptoms=$_POST['symptoms'];
$medication=$_POST['Medication'];
$q=mysqli_query($conn,"Insert into reports values (".$_SESSION['id'].",".$_POST['patient_id'].",'".$symptoms."','".$medication."','".date('yy-m-d h:i:s')."');");	
$_SESSION["tim"]=time();
header("Location:doctor_booking.php");
?>
