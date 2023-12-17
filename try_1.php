<?php
echo "hello";
$conn=mysqli_connect("localhost","root","","testdb");
if(!$conn){
   die("failed");
}
echo "sucess";
$h=mysqli_query($conn,"Select * from doctor ;");
$r=mysqli_num_rows($h);
if($r>0){
   while($row=mysqli_fetch_assoc($h)){
       echo $row["ID"];
}

}
?>
<html>
<body>
asadsaf

</body>
</html>