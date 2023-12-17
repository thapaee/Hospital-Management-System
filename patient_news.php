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
#hello{
   display:inline-block;
   background-color:white;
   margin-left:16%;
}
</style>
<script>
function getNews(str) {
  if (str.length==0) {
    document.getElementById("rssOutput").innerHTML="";
    return;
  }
  if (window.XMLHttpRequest) {
    
    xmlhttp=new XMLHttpRequest();
  } else {  
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("rssOutput").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getrss.php?q="+str,true);
  xmlhttp.send();
}
</script>
</head>
<body>

<div class="navigation">
  <div class="round">
  </div>
    <a href="patient_dash.php"><button>Overview</button></a>
    <a href="patient_booking.php"><button>Book ticket</button></a>
    <a href="patient_report.php"><button>Check Report</button></a>
    <a href="patient_notice.php"><button>Check Notice</button></a>
    <a href="patient_news.php"><button style="background-color:black;color:white;">News</button></a>
    <a href="logout.php"><button>Sign Out</button></a>
</div>

<div class="top"><center><h2>View News as per your choice</h2></center><hr></div>

<div id="hello">
<div>
<form>
<select onchange="getNews(this.value)">
<option value="">Select a disease:</option>
<option value="A">Alzheimer</option>
<option value="B">HIV</option>
<option value="C">Cancer</option>
<option value="D">Diabetes</option>
<option value="E">High Blood Pressure</option>
<option value="F">Mental Health</option>
<option value="G">Depression</option>
<option value="H">Asthma</option>
<option value="I">Cholestrol</option>
</select>
</form>
</div>
<div id="rssOutput">News will be listed here as per your selection...</div>
</div>
</body>
</html>