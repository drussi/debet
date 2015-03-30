
<?
     $query='select * from services';
?>

		  <div class="widget-block" style="width:70%">
	    	  <div class="widget-head">
						<h5><i class="color-icons cog_co"></i>&nbsp;&nbsp;Администрирование услуг и цен</h5> 
		 	  </div>
					
				<div class="widget-content" >
				   <div class="widget-box">
				     <div class="white-box well">
						<form method="post" class="form-horizontal well">
						   <fieldset > 
						     <div class="control-group">
							     <label class="control-label">Выбрать услугу</label>
							       <div class="controls" style="float:left">
							          <select  name="service" class="span4">
				                      <option>--------------------------</option>
				                            <?
				                               $result=mysql_query($query);
				                                  while($row=mysql_fetch_array($result)){
				                            	      echo "<option value=".$row['service_id'].">".$row['service_name'];
				                               }
				                            ?>
				                      </select>&nbsp;&nbsp;&nbsp;&nbsp;
									  <button class="btn btn-primary" type="submit"><i class="icon-search icon-white"></i>&nbsp;Найти</button>
									  <a href="index.php?page=7&add=1" class="btn btn-success"><i class="icon-cog icon-white"></i>&nbsp;Новая услуга</a>
						    	</div>
						     </div>	
						  </fieldset>
					   </form>
					  </div> 
			     </div>
			</div>
	    </div>	
					   
   <?
      if( $_POST['service']>0 || $_GET['service']>0 ) {
	       $service=isset($_POST['service'])?$_POST['service']:$_GET['service'];
   	       $qs="select * from  services where service_id='".$service."'";
 	       $ress=mysql_query($qs);
 	       $rs=mysql_fetch_array($ress);
 	?>	
	  
	    <div class="nonboxy-widget" style="width:70%"> 
    
		     <div class="widget-content" >
			    <form method="post" action="lib/f_service_edit.php" id="serviceForm" name="serviceForm" class="form-horizontal well">
				  <fieldset > 
						<div class="control-group">							
							
							<label class="control-label" style="color:navy; width:60%">
							 <span class="color-icons page_white_edit_co"></span>&nbsp;&nbsp;
							    Редактирование услуги
							</label>
							
						</div>	
						</fieldset>
		
				      <fieldset > 
						<div class="control-group">
							<label class="control-label">Услуга</label>
							<div class="controls" style="float:left">
							   <input type="text" class="span4" name="service_name"  value="<?=$rs['service_name']?>">
							</div>
						</div>	
					  </fieldset>
					  
					  <fieldset > 
						<div class="control-group">
							<label class="control-label">Новая цена</label>
							<div class="controls" style="float:left">
							   <input type="text" class="span1" name="service_price"  value="<?=$rs['service_price']?>">&nbsp;&nbsp;руб.
							</div>
						</div>	
					  </fieldset>
					
												
						<fieldset >
						   <div class="control-group">
						      <label class="control-label">История цен</label>
							    <div class="controls" style="float:left">					         
					  	                  <?
					  	                      $querys="select * from services_prices where service_id='".$service."' order by price_id desc";
					  	                      $results=mysql_query($querys);
											  echo "<table width=100% border=1 cellpadding=5px>
											           <tr align=center>
											                <td  style='font-weight:bold'>Цена</td><td  style='font-weight:bold'>Дата начала</td><td  style='font-weight:bold'>Дата окончания</td>
													   </tr>";
				                               while($rows=mysql_fetch_array($results)){
											        $dt=isset($rows['date_to'])?date('d.m.Y',strtotime($rows['date_to'])):'';
				                     	               echo "<tr><td class=green_text>".$rows['price']."</td>
												             <td class=green_text>".date('d.m.Y',strtotime($rows['date_from']))."</td>
															 <td class=green_text>".$dt."</td></tr>";
				                               }
											   echo "</table>"
					  	                  ?>
							    </div>  
						   </div>	
						</fieldset>
						
						<div class="form-actions" style="padding-left:0; padding-bottom:0">
									<button class="btn btn-primary" type="submit" >Сохранить</button>									
									<input type="hidden" name="service" value="<?=$service ?>"> 									
						</div>
	     
		           
	            </form>		
			</div>		   
		</div>				
	<? } ?>					
			
	  
  <?
    if(  $_GET['add']==1 ) {
 	?>	
	  
	    <div class="nonboxy-widget" style="width:70%"> 
    
		     <div class="widget-content" >
			      <form method="post" action="lib/f_service_add.php" id="serviceForm" name="serviceForm" class="form-horizontal well">
				  <fieldset > 
						<div class="control-group">							
							
							<label class="control-label" style="color:navy; width:60%">
							 <span class="color-icons page_white_edit_co"></span>&nbsp;
							    Новая услуга
							</label>
							
						</div>	
						</fieldset>
		
				      <fieldset > 
						<div class="control-group">
							<label class="control-label">Услуга</label>
							<div class="controls" style="float:left">
							   <input type="text" class="span4" name="service_name" >
							</div>
						</div>	
					  </fieldset>
					  
					  <fieldset > 
						<div class="control-group">
							<label class="control-label">Цена</label>
							<div class="controls" style="float:left">
							   <input type="text" class="span1" name="service_price" >&nbsp;&nbsp;руб.
							</div>
						</div>	
					  </fieldset>
					

						
						<div class="form-actions" style="padding-left:0; padding-bottom:0">
									<button class="btn btn-primary" type="submit" >Добавить</button>									
									<input type="hidden" name="service" value="<?=$service ?>"> 									
						</div>
	     
		           
	            </form>	
			</div>		   
		</div>				
	<? } ?>				