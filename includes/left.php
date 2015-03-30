	<aside id="sidebar" class="column">
		<form class="quick_search" action="index.php" method=post>
			<input type="text" value="Поиск инвестора" name=qcust onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
			<input type="hidden" name="num_form" value="1">
		</form>
		<hr/>
<?
  $rights=implode(',',$accept_array);
  $querys="select * from sections order by section_id" ;
  $results=mysql_query($querys);

  while($row=mysql_fetch_array($results)){
  	 $queryp="select * from pages p where section_id='".$row['section_id']."' and page_id in (".$rights.") order by orderby";
  	 $resultp=mysql_query($queryp);
  	 if( mysql_num_rows($resultp)>0){  	 	echo '<h3>'.$row['section_name'].'</h3>';
  	 	echo "<ul class=\"toggle\">";
  	 	 while ($rowp=mysql_fetch_array($resultp)){  	 	 	echo "<li class=\"".$rowp['icon']."\"><a href=\"index.php?page=".$rowp['page_id']."\">".$rowp['page_name']."</a></li>" ;  	 	 }
  	 	echo "</ul>";  	 }
  }
?>

<!--
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2011 Website Admin</strong></p>
			<p>Theme by <a href="http://www.medialoot.com">MediaLoot</a></p>
		</footer>
-->
	</aside><!-- end of sidebar -->

