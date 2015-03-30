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


//echo $query;
//exit();

$result=mysql_query($query);
$i = mysql_insert_id();
$err=0;
}
header('Location:'.$path.'index.php?page=3&cid='.$i.'&err='.$err);
?>