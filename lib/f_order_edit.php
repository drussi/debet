<?php
session_start();
require_once("../includes/config.php");
require_once("../includes/conn.php");


if(!empty($_POST['ddate']) && $_POST['ddate']!=''){
	$bdateArr = explode('.',$_POST['ddate']);
	$ddate=$bdateArr[2].'-'.$bdateArr[1].'-'.$bdateArr[0];
}
else
    $ddate='0000-00-00';

if(!empty($_POST['adate']) && $_POST['adate']!=''){
	$pdateArr = explode('.',$_POST['adate']);
	$adate=$pdateArr[2].'-'.$pdateArr[1].'-'.$pdateArr[0];
}
else
    $adate='0000-00-00';

$cnid=$_POST['cnid'];

$query="update contracts set  contract_date='".$ddate."', act_date='".$adate."', note='".$_POST['note']."' 
   where contract_id='".$cnid."'";
$result=mysql_query($query);

$del="delete from contracts_services where contract_id='".$cnid."'";
mysql_query($del);

    $services=$_POST['service'];
	$sq=$_POST['sq'];
     for($i=0;$i<5;$i++){
         if($services[$i]>0 && $sq[$i]>0){
		    $squery="insert into contracts_services(service_id, contract_id, quantity) 
			  values('".$services[$i]."','".$cnid."','".$sq[$i]."')";	
			 $sres=mysql_query($squery);  
			 $rec=mysql_insert_id();
		 }		
     }



  header('Location:'.$path.'index.php?page=5&cnid='.$cnid.'&err='.$err);

?>