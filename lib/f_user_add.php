<?
session_start();
require_once("../includes/config.php");
require_once("../includes/conn.php");


$query="INSERT INTO users (`family`, `name`, `surname`, `login`, `pass`, `role_id`)
VALUES ('".$_POST['family']."','".$_POST['name']."',  '".$_POST['surname']."',  '".trim($_POST['login'])."',
  '".trim($_POST['pass'])."', '".$_POST['role']."')";

$result=mysql_query($query);
$i = mysql_insert_id();
header('Location:' . $path.'index.php?page=6&user='.$i);

?>