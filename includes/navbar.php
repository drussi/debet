<div class="navbar navbar-fixed-top">
 <div class="branding">
        <div class="head_text" style="margin-top:10px" >
				         ops-mpa
				    </div>
		      </div>
  <div class="navbar-inner top-nav full-fluid">
    <div class="container-fluid">
       <div class="nav-collapse collapse">
        <ul class="nav">
     
  <!--    <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> -->
  
  <?
  $rights=implode(',',$accept_array);
  $querys="select * from sections order by section_id" ;
  $results=mysql_query($querys);

  while($row=mysql_fetch_array($results)){

  	 $queryp="select * from pages p where section_id='".$row['section_id']."' and page_id in (".$rights.") order by orderby";
  	 $resultp=mysql_query($queryp);
  	 if( mysql_num_rows($resultp)>0){
  	 	echo "<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"nav-icon list\"></i> ".$row['section_name']." <b class=\"caret\"></b></a>"; 
  	 	echo "<ul class=\"dropdown-menu\">";
  	 	 while ($rowp=mysql_fetch_array($resultp)){
  	 	 	echo "<li><a href=\"index.php?page=".$rowp['page_id']."\">".$rowp['page_name']."</a></li>" ;
  	 	 }
  	 	echo "</ul>";
		echo "</li>";
  	 }
  }
?>
  
  
  	  

		  
		  
        </ul>
      </div>
    </div>
  </div>
</div> <!-- верхняя навигация -->