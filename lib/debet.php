
<script type="text/javascript">

getServices(-1);

function getServices(provider){
	  $.ajax({
                        type: "POST",
                        url: "<?=$path?>lib/ajax.base.php",
                        data: { action: 'getServices', provider: provider},
                        cache: false,
                        success: function(responce){ $('div[id="selectService"]').html(responce); }
           });
      getHouses(provider);
}	


function getHouses(provider){
	  $.ajax({
                        type: "POST",
                        url: "<?=$path?>lib/ajax.base.php",
                        data: { action: 'getHouses', provider: provider},
                        cache: false,
                        success: function(responce){ $('div[id="selectHouse"]').html(responce); }
           });
}	




</script>
<style>

.tbl_length_dt{
	width:50px;
	height:20px;
}

</style>

<?
  if($_POST['search'] == 18){
  	 
	 $qs="select c.contract_id, c.contract_date, c.act_date, cm.family, cm.name, cm.surname, cm.customer_id from  customers cm
		     left join contracts c  on cm.customer_id=c.customer_id where ";
			  
	 $where =!empty($_POST['family'])?" family like '".$_POST['family']."%'":"";
	 
	  if(isset($_POST['order']) && $_POST['order']>0 ){
	     $where.= !empty($where)?' and ':'';
		 $where.= " contract_id='".$_POST['order']."' ";
	  }
	  
	  if(isset($_POST['df']) && $_POST['df']>0){
	  
	    $dateArr = explode('.',$_POST['df']);
	    $df=$dateArr[2].'-'.$dateArr[1].'-'.$dateArr[0];
	  
	    
	  
	     $where.= !empty($where)?' and ':'';
		 $where.= " contract_date >= '".$df."' ";
		 
		  if(isset($_POST['dt']) && $_POST['dt']>0){		 
		      $date1Arr = explode('.',$_POST['dt']);
	          $dt=$date1Arr[2].'-'.$date1Arr[1].'-'.$date1Arr[0];
		      $where.= isset($dt)?" and act_date < '".$dt."'":"";
		  }
	  }
	  
	  $qs.= $where.' order by family, contract_id';		
	  $res = mysql_query($qs);
	 
  }
?>
	
	<div class="page-header" style="margin:10px">
			<h1><div style="z-index:1000; position:absolute; margin-left:10%"><img id="file_loading" src="img/file_loading.gif" style="display:none;"></div>
			<i class="color-icons script_co" style="margin-top:5px"></i>&nbsp;<small>Работа с дебеторской задолженностью</small></h1>
		</div>
	   
	<div class="widget-block" style="width:80%; min-width:850px">
	    	  <div class="widget-head">
						<h5>
						<span class="black-icons bended_arrow_up" style="float:left" onclick="hideDiv()" id="arr_up0"></span>
						<span class="black-icons bended_arrow_down"  style="float:left" onclick="showDiv()" id="arr_down0"></span>
						<i class="color-icons funnel_co"></i>&nbsp;&nbsp;Поиск делопроизводств
						</h5>
		     </div>
					
		     <div class="widget-content" id="wc">
						<div class="widget-box">
						
						
                      <form id="debet" name="debet" method="post" class="form-horizontal well">
				   
				        
				     	<?	
						 $qp='select * from providers where debet=1';
							$rp=mysql_query($qp);
						?>					   
						
						<fieldset style="width:40%; float:left;"> 
						<div class="control-group">
							<label class="control-label">Поставщик</label>
							 <div class="controls" style="float:left">
							    <select name=provider id="provider" class="span3"   onchange="getServices(this.value)" > 
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
						
						<?	
						    $qp='select * from providers where debet=1';
							$rp=mysql_query($qp);
						?>
						
						<fieldset style="width:60%; float:left; min-width:500px; height:40px" > 
						<div class="control-group">
							<label class="control-label">Услуга</label>
							 <div class="controls" style="float:left">
							    <div id=selectService></div>
							</div>
						</div>	
						</fieldset>
						
						<fieldset style="width:40%; float:left; float:left; min-width:400px; height:40px" > 
						<div class="control-group">
							<label class="control-label">Дома</label>
							 <div class="controls" style="float:left">
							    <div id=selectHouse></div>
							</div>
						</div>	
						</fieldset>
						
						<fieldset style="width:60%; float:left;" > 
						<div class="control-group">
							<label class="control-label">ФИО</label>
							 <div class="controls" style="float:left">
							    <input type="text" class="span3" name="fio" id=fio>
							</div>
						</div>	
						</fieldset>
						
						<?	
						    $qs='select * from debet_state';
							$rs=mysql_query($qs);
						?>
						<fieldset style="width:40%; float:left;" > 
						<div class="control-group">
							<label class="control-label">Состояние</label>
							 <div class="controls" style="float:left">							     
						          <select name=state id="state" class="span4"> 
								   <option></option>								  
								  <?
								    while($row=mysql_fetch_array($rs)){
										echo '<option value='.$row['state_id'].'>'.$row['name'].'</option>';
									}
								  ?> 
								</select>
							</div>
						</div>	
						</fieldset>
						
						<fieldset style="width:60%; float:left;" > 
						<div class="control-group">
							<label class="control-label">Даты состояния</label>
							 <div class="controls" style="float:left">							     
						               	от&nbsp;  <input type="date" class="span2"  name="dfstatus" id="dfstatus">&nbsp;
										 до&nbsp; <input type="date" class="span2"  name="dtstatus" id="dtstatus">
							</div>
						</div>	
						</fieldset>
						
						<fieldset style="width:40%; float:left;" > 
						<div class="control-group">
							<label class="control-label">Дебет(иск)</label>
							 <div class="controls" style="float:left">							     
						            	от&nbsp;  <input type="text" class="span1"  name="debetf" id="debetf">&nbsp;&nbsp;&nbsp;
										до&nbsp; <input type="text" class="span1"  name="debett" id="debett">&nbsp; руб.
							</div>
						</div>	
						</fieldset>
						
						<fieldset style="width:60%; float:left;" > 
						<div class="control-group">
							<label class="control-label">Даты задолж.</label>
							 <div class="controls" style="float:left">							     
						               	от&nbsp;  <input type="date" class="span2"  name="dfdebet" id="dfdebet">&nbsp;
										 до&nbsp; <input type="date" class="span2"  name="dtdebet" id="dtdebet">
							</div>
						</div>	
						</fieldset>
						
						<fieldset style="width:40%; float:left;" > 
						<div class="control-group">
							<label class="control-label">Лицевой счет</label>
							 <div class="controls" style="float:left">							     
						            	<input type="text" class="span2" name="ls" id=ls>
							</div>
						</div>	
						</fieldset>
						
						<fieldset style="width:60%; float:left;" > 
						<div class="control-group">
							<label class="control-label">Дата заседания</label>
							<div class="controls" style="float:left">
							          от&nbsp;  <input type="date" class="span2"  name="dflaw" id="dflaw">&nbsp;
										 до&nbsp; <input type="date" class="span2"  name="dtlaw" id="dtlaw">
							</div>
						</div>	
						</fieldset>
						
						<fieldset > 
						<div >
						
							<div class="controls" style="float:left">
							         
							</div>
						</div>	
						</fieldset>
					
						<div class="form-actions" style="padding-left:0; margin:0; padding-bottom:5px">
									<button class="btn btn-primary" style="width:20%" id=btnSearch type="button">Найти</button>									
						</div>
			   </form>
			  
			     
				       </div>
			        </div>

		</div>

<div class="widget-block" style="width:80%; min-width:850px">
	    	  <div class="widget-head">
						<h5>
						<span class="black-icons bended_arrow_up" style="float:left" onclick="hideDiv1()" id="arr_up1"></span>
						<span class="black-icons bended_arrow_down" hidden="hidden"  style="float:left" onclick="showDiv1()" id="arr_down1"></span>
						<i class="color-icons page_copy_co"></i>&nbsp;&nbsp;Групповые операции с выбранными делами
						</h5>
		     </div>
					
				<div class="widget-content" id="wc1">
					<div class="widget-box">
						
                      <form id="debet_group" name="debet_group" method="post" class="form-horizontal well">
						   
				        <fieldset style="float:left;width:90%" > 
						<div class="control-group">
							<label class="control-label">Изменить состояние</label>
							 <div class="controls" style="float:left; width:60%">
							      <select name=state_ch id="state_ch" class="span4" style="float:left;" >
								   <option></option>								  
								  <?
								    mysql_data_seek($rs,0);
								    while($row=mysql_fetch_array($rs)){
										echo '<option value='.$row['state_id'].'>'.$row['name'].'</option>';
									}
								  ?> 
								</select>
							   <button class="btn btn-primary" style="float:right; width:20%" id=btnState type="button">Изменить</button>
							</div>
						 </div>	
						</fieldset>
						
						<fieldset style="float:left;width:90%" > 
						<div class="control-group">
							<label class="control-label">Распечатать документы</label>
							 <div class="controls" style="float:left; width:60%">
							     <select name=doc_print id="doc_print" class="span4" style="float:left;" >
								   <option></option>								  
								   <option value="1">Реестр на госпошлину</option>
								   <option value="2">Исковое заявление</option>
								</select>
								<button class="btn btn-primary" style="float:right; width:20%" id=btnPrint type="button">Распечатать</button>
							</div>
							
																		
					    	
						</div>	
						</fieldset>
						
						<fieldset > 
						<div style="height:90px">
						   <label class="control-label"></label>
							<div class="controls" style="float:left">
							     &nbsp;<hr>    
							</div>
						</div>	
						
						</fieldset>
						
						
			            </form>
			     
				       </div>
			        </div>

		</div>

          

        <div id="search_debet"></div>
	
	