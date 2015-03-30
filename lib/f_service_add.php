<?php
session_start();
require_once("../includes/config.php");
require_once("../includes/conn.php");



$q="insert into services( service_name ) values('".$_POST['service_name']."')";
$res=mysql_query($q);
$service = mysql_insert_id();

if(isset($_POST['service_price'])){
  
  $qi="insert into services_prices(service_id, price, date_from,  user_id) values('".$service."', '".$_POST['service_price']."', '".date('Y-m-d')."', '".$_SESSION['uid']."')";
  $ri=mysql_query($qi);
}

header('Location:' . $path.'index.php?page=7&service='.$service);
?>