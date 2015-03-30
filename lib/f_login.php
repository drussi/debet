<?
session_start();


require_once("../includes/config.php");
require_once("../includes/conn.php");


$query="select * from users u
  join roles r on r.role_id=u.role_id
   where u.login='".$_POST['login']."'  and pass='".$_POST['pass']."'";
//echo $query;
//exit();

$result=mysql_query($query);
 if(mysql_num_rows($result)==1){
 	$row=mysql_fetch_array($result);
 	$_SESSION['uid']=$row['user_id'];
 	$_SESSION['fio']=$row['family']." ".$row['name']." ".$row['surname'];
 	$_SESSION['accept_array']=explode(';',$row['access']);
 	header('Location:'.$path.'index.php');
 }
 else{
 	header('Location:'.$path.'login.php');
 }

?>