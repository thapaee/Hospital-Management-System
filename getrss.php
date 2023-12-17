<?php
session_start();
$_SESSION["tim"]=time();
//get the q parameter from URL
$q=$_GET["q"];

if($q=="A") {
  $xml=("https://www.medicinenet.com/rss/general/alzheimers.xml"); 
  } 
elseif($q=="B") {
  $xml=("https://www.medicinenet.com/rss/general/hiv.xml");
}
elseif($q=="C") {
  $xml=("https://www.medicinenet.com/rss/general/cancer.xml");
}
elseif($q=="D") {
  $xml=("https://www.medicinenet.com/rss/general/diabetes.xml");
}
elseif($q=="E") {
  $xml=("https://www.medicinenet.com/rss/general/high_blood_pressure.xml");
}
elseif($q=="F") {
  $xml=("https://www.medicinenet.com/rss/general/mental_health.xml");
}
elseif($q=="G") {
  $xml=("https://www.medicinenet.com/rss/general/depression.xml");
}
elseif($q=="H") {
  $xml=("https://www.medicinenet.com/rss/general/asthma.xml");
}
elseif($q=="I") {
  $xml=("https://www.medicinenet.com/rss/general/cholesterol.xml");
}

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//get and output "<item>" elements
$x=$xmlDoc->getElementsByTagName('item');
for ($i=0; $i<5; $i++) {
  $item_1=$x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
  $item_2=$x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
  $item_3=$x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
  echo ("<p><a href='" . $item_2. "'>" . $item_1 . "</a>");
  echo ("<br>");
  echo ($item_3 . "</p>");
}
?>