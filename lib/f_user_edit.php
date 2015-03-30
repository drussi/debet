<?
session_start();
require_once("../includes/config.php");
require_once("../includes/conn.php");



$q="update users set
      `family`='".$_POST['family']."', `name`='".$_POST['name']."', `surname`='".$_POST['surname']."',
       `login`='".$_POST['login']."', `pass`='".$_POST['pass']."',
       `role_id`='".$_POST['role']."'  where user_id='".$_POST['userid']."'";

$res=mysql_query($q);

header('Location:' . $path.'index.php?page=6&user='.$_POST['userid']);
?>