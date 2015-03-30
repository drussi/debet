<?php

require_once("../includes/config.php");
require_once("../includes/conn.php");
ini_set(default_charset,"windows-1251");

 switch ($_POST['action']){
        case "getServices":
		 if($_POST['provider']==-1){
		 	echo "<select name=service id=service class=span3>
					<option></option></select>";
		 }
		 else{
		  $sql="SELECT * FROM services WHERE provider_id = '".$_POST['provider']."'";
          $res=mysql_query($sql);
		  echo "<select name=service class=span3>
					<option></option>";
		     while($row=mysql_fetch_array($res)){
			 	echo "<option value=".$row['service_id'].">".$row['name']."</option>";
			 }
		  echo "</select>";	
		 }
		break;
		
		case "getHouses":
		  if($_POST['provider']==-1){
		 	echo "<select name=house  id=house  class=span3>
					<option></option></select>";
		 }
		 else{
		  $sql="SELECT distinct house  FROM contracts WHERE provider_id = '".$_POST['provider']."'";
          $res=mysql_query($sql);
		  echo "<select name=house class=span3>
					<option></option>";
		     while($row=mysql_fetch_array($res)){
			 	echo "<option value='".$row['house']."'>".$row['house']."</option>";
			 }
		  echo "</select>";	
		  } 
		break;
 }
?>