<?php
session_start();
require_once("../includes/config.php");
require_once("../includes/conn.php");



$q="update services set
      `service_name`='".$_POST['service_name']."'  where service_id='".$_POST['service']."'";
$res=mysql_query($q);

if(isset($_POST['service_price'])){
  $qp="update services_prices set date_to='".date('Y-m-d')."' where service_id='".$_POST['service']."' and date_to is null";
  $rp=mysql_query($qp);
  
  $qi="insert into services_prices(service_id, price, date_from,  user_id) values('".$_POST['service']."', '".$_POST['service_price']."', '".date('Y-m-d')."', '".$_SESSION['uid']."')";
  $ri=mysql_query($qi);
}

header('Location:' . $path.'index.php?page=7&service='.$_POST['service']);
?>