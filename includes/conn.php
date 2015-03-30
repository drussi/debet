<?
  $link=mysql_connect($dhost, $duser, $dpass);
  mysql_select_db($dbase);
  mysql_query('SET character_set_database = cp1251');
  mysql_query('SET NAMES cp1251');
  
  
?>