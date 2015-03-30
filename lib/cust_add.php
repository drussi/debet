
<script type="text/javascript">

  jQuery(function($) {
    $.mask.definitions['~']='[+-]';
    $('#pdate').mask('99.99.9999');
    $('#dborn').mask('99.99.9999');
	$('#telmobil').mask('(999) 999-9999');
    });

</script>


	   
		  <div class="widget-block" style="width:70%">
	    	  <div class="widget-head">
						<h5><i class="color-icons user_co"></i>&nbsp;&nbsp;НОВЫЙ ЗАКАЗЧИК</h5> 
		 	</div>
					
					<div class="widget-content" >
						<div class="widget-box">
						
						
                        <form id="custForm" name="custForm" method="post" action="lib/f_cust_ins.php" class="form-horizontal well">
				   
				        <fieldset > 
						<div class="control-group">
							<label class="control-label">Фамилия</label>
							<div class="controls" style="float:left">
							   <input type="text" class="span4" name="family" >
							</div>
						</div>	
						</fieldset>
						<fieldset > 
						 <div class="control-group">
							<label class="control-label">Имя</label>
							<div class="controls" style="float:left">
							  <input type="text" class="span4" name="iname" >
							</div>  
						 </div>	
						</fieldset>
						
						<fieldset> 
						<div class="control-group">
							<label class="control-label">Отчество</label>
							<div class="controls" style="float:left">
							<input type="text" class="span4"  name="surname">
							</div>  
						 </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Дата рождения</label>
							    <div class="controls" style="float:left">
							       <input type="text" name="born" id="dborn" class="span2" style="text-align:center" >
							    </div>  
						   </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Место рождения</label>
							    <div class="controls" style="float:left">
							       <input type="text"  name="bplace" class="span4" >
							    </div>  
						   </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Мобильный телефон</label>
							    <div class="controls" style="float:left">
							        <input type="text" name="telmobil" id="telmobil" class="span2">
							    </div>  
						   </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Электронная почта</label>
							    <div class="controls" style="float:left">
							        <input type="text" name="email" class="span3">
							    </div>  
						   </div>	
						</fieldset>
						<hr>
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Паспорт</label>
							    <div class="controls" style="float:left">
							        серия:&nbsp;&nbsp;<input type="text"  class="span1" name="pser">&nbsp;&nbsp;
									номер:&nbsp;&nbsp;<input type="text" class="span2" name="pnum" >&nbsp;&nbsp;
									код:&nbsp;&nbsp;<input type="text" class="span1"  name="pkod"  >&nbsp;&nbsp;
							    </div>  
						   </div>	
						</fieldset>
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label"></label>
							    <div class="controls" style="float:left">
							        выдан:&nbsp;&nbsp;<input type="text" class="span4" name="authority" >
							    </div>  
						   </div>	
						</fieldset>
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label"></label>
							    <div class="controls" style="float:left">
							        когда:&nbsp;&nbsp; <input type="text" name=pdate id=pdate  class="span2" style="text-align:center">
							    </div>  
						   </div>	
						</fieldset>
						<hr>
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Адрес</label>
							    <div class="controls" style="float:left">
							        область:&nbsp;&nbsp;<input type="text" name="adrRegion" class="span4">
							    </div>  
						   </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label"></label>
							    <div class="controls" style="float:left">
							        район:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="adrZone" class="span4">
							    </div>  
						   </div>	
						</fieldset>		
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label"></label>
							    <div class="controls" style="float:left">
							        населенный пункт:&nbsp;&nbsp;<input type="text" name="adrCity" class="span3">
							    </div>  
						   </div>	
						</fieldset>	
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label"></label>
							    <div class="controls" style="float:left">
							        улица:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="adrStreet" class="span4">
							    </div>  
						   </div>	
						</fieldset>					
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label"></label>
							    <div class="controls" style="float:left">
							        дом:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="adrHouse" class="span1">&nbsp;&nbsp;&nbsp;&nbsp;
									кв:&nbsp;&nbsp;&nbsp;<input type="text" name="adrFlat" class="span1">
							    </div>  
						   </div>	
						</fieldset>	
						<hr>
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Доп. контакты</label>
							    <div class="controls" style="float:left">
							        Skype:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  class="span2" name="skype">&nbsp;&nbsp;
									ICQ:&nbsp;&nbsp;<input type="text" class="span2" name="icq" >&nbsp;&nbsp;
									
							    </div>  
						   </div>	
						</fieldset>				

						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Примечание</label>
							    <div class="controls" style="float:left">
							       <input type="text" name="note" class="span6">
							    </div>  
						   </div>	
						</fieldset>		
					
						<div class="form-actions" style="padding-left:0">
									<button class="btn btn-primary" type="submit">Сохранить</button>									
						</div>
			  </form>
			  
			     
				</div>
			</div>

		</div><!-- end of post new article -->
	

