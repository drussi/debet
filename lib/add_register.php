
<script type="text/javascript">

  jQuery(function($) {
    $.mask.definitions['~']='[+-]';
    $('#pdate').mask('99.99.9999');
    $('#dborn').mask('99.99.9999');
	$('#telmobil').mask('(999) 999-9999');
    });
	
getServices(-1);	
	
function getServices(provider){
	  $.ajax({
                        type: "POST",
                        url: "<?=$path?>lib/ajax.base.php",
                        data: { action: 'getServices', provider: provider},
                        cache: false,
                        success: function(responce){ $('div[id="selectService"]').html(responce); }
           });
	 getRname();	   
}	

function getRname() {
				provider=$('select[name="provider"]').val();
				rdate = $("#rdate").val();
				if(provider>0 && !rdate==''){
				   $("#rname").val($('select[name="provider"] option:selected').text() + '_' + rdate ); 
				}
}

</script>


	   
		  <div class="widget-block" style="width:70%">
	    	  <div class="widget-head">
						<h5><i class="color-icons user_co"></i>&nbsp;&nbsp;НОВЫЙ РЕЕСТР</h5> 
		     </div>
					
					<div class="widget-content" >
						<div class="widget-box">
						
						
                      <form id="addRegister" name="addRegister" method="post"  action="lib/f_register_add.php" class="form-horizontal well" enctype="multipart/form-data">
				   
				        <fieldset > 
						<div class="control-group">
							<label class="control-label">Дата реестра</label>
							<div class="controls" style="float:left">
							   <input type="date" class="span2" name="rdate" id="rdate">
							</div>
						</div>	
						</fieldset>
						
				     	<?	
						 $qp='select * from providers';
							$rp=mysql_query($qp);
						?>					   
						
						<fieldset > 
						<div class="control-group">
							<label class="control-label">Поставщик</label>
							 <div class="controls" style="float:left">
							    <select name=provider id="provider" class="span3" onchange="getServices(this.value)" > 
								  <option></option>
								  <?
								    while($row=mysql_fetch_array($rp)){
										echo '<option value='.$row['provider_id'].'>'.$row['name'].'</option>';
									}
								  ?> 
								</select>
							</div>
						</div>	
						</fieldset>
						
						<fieldset > 
						<div class="control-group">
							<label class="control-label">Услуга</label>
							 <div class="controls" style="float:left">
							      <div id=selectService></div>
							</div>
						</div>	
						</fieldset>
						
						<fieldset > 
						<div class="control-group">
							<label class="control-label">Файл реестра</label>
							<div class="controls" style="float:left">
							  <input type="file" class="span3" name="register_file">
							</div>
						</div>
						</fieldset>
						<fieldset > 
						<div class="control-group">
							<label class="control-label">Название реестра</label>
							<div class="controls" style="float:left">
							   <input type="text" class="span4" name="rname" id=rname>
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
	

