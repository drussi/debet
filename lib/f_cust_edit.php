<?

session_start();
require_once("../includes/config.php");
require_once("../includes/conn.php");

if(!empty($_POST['born']) && $_POST['born']!=''){
	$bdateArr = explode('.',$_POST['born']);
	$born=$bdateArr[2].'-'.$bdateArr[1].'-'.$bdateArr[0];
}
else
    $born='0000-00-00';

if(!empty($_POST['pdate']) && $_POST['pdate']!=''){
	$pdateArr = explode('.',$_POST['pdate']);
	$pdate=$pdateArr[2].'-'.$pdateArr[1].'-'.$pdateArr[0];
}
else
    $pdate='0000-00-00';


$update="update customers set family='".$_POST['family']."', name='".$_POST['iname']."', surname='".$_POST['surname']."',  born='".$born."',
pser='".$_POST['pser']."', pnum='".$_POST['pnum']."', pkod='".$_POST['pkod']."', pdate='".$pdate."', authority='".$_POST['authority']."', 
bplace='".$_POST['bplace']."', adrRegion='".$_POST['adrRegion']."', adrZone='".$_POST['adrZone']."', adrCity='".$_POST['adrCity']."', adrStreet='".$_POST['adrStreet']."', 
adrHouse='".$_POST['adrHouse']."', adrFlat='".$_POST['adrFlat']."', telmobil='".$_POST['telmobil']."',  note='".$_POST['note']."',
manager='".$_SESSION['uid']."', email='".$_POST['email']."', ICQ='".$_POST['icq']."', skype='".$_POST['skype']."'
 where customer_id='".$_POST['cid']."'";
 
 
 $result=mysql_query($update);

/*
$check="select customer_id from customers where family='".$_POST['family']."' and name='".$_POST['iname']."'
 and surname='".$_POST['surname']."' and born='".$born."'";
$res_check=mysql_query($check);
  if(mysql_num_rows($res_check)>0){
   	$row_check=mysql_fetch_array($res_check);
    $i = $row_check['customer_id'];
    $err=2;
 }
 else{
$query="INSERT INTO customers (family, name, surname,  born,
pser, pnum, pkod, pdate, authority, bplace, adrRegion, adrZone, adrCity,
adrStreet, adrHouse, adrFlat, telmobil,  note,
manager, email, ICQ)
VALUES ('".$_POST['family']."','".$_POST['iname']."',  '".$_POST['surname']."','".$born."',
'".$_POST['pser']."', '".$_POST['pnum']."', '".$_POST['pkod']."', '".$pdate."', '".$_POST['authority']."',
'".$_POST['bplace']."', '".$_POST['adrRegion']."', '".$_POST['adrZone']."', '".$_POST['adrCity']."',
'".$_POST['adrStreet']."', '".$_POST['adrHouse']."', '".$_POST['adrFlat']."', '".$_POST['telmobil']."',
'".$_POST['note']."', '".$_SESSION['uid']."',
'".$_POST['email']."', '".$_POST['icq']."')";


$result=mysql_query($query);
$i = mysql_insert_id();
$err=0;
}*/

header('Location:'.$path.'index.php?page=4&cid='.$_POST['cid'].'&err='.$err);
?>