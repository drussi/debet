<?

session_start();
require("includes/config.php");
require("includes/conn.php");
require('lib/form_handler_manager.php');
?>
<html lang="en">
<?
require("includes/header.php");
?>

 
 <body>

<?
require("includes/navbar.php");
?>

	<div id="main-content" class="full-fluid">
       <div class="container-fluid" >
	      <table width="100%" >
	        <tr><td align="center">
			
			<!--
			 <ul class="breadcrumb"  style="width:80%">
              <li class="active"><a href="index.php?page=12"><span class="color-icons find_co"></span> Поиск</a><span class="divider">&raquo;</span></li>
               <li class="active">
			     <?
			       echo $_SESSION['breadcrumbs'];
			     ?>
			  </li>	  
            </ul>
            -->
			
			
	       <?
  	         // require("includes/test_content.php");
			  eval($content);
           ?>
		   	</td></tr></table>	
 	  </div>
	</div>

<?
   require("includes/footer.php");
?>   

 </body>
</html>