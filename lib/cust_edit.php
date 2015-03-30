<?
session_start();
require_once("includes/config.php");
require_once("includes/conn.php");
?>

<script type="text/javascript">

  jQuery(function($) {
    $.mask.definitions['~']='[+-]';
    $('#pdate').mask('99.99.9999');
    $('#dborn').mask('99.99.9999');
	$('#telmobil').mask('(999) 999-9999');
    });

</script>

<?


$query="select * from customers where customer_id ='".$_SESSION['cid']."'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);


$cquery="select * from contracts where customer_id ='".$_SESSION['cid']."' order by contract_id ";
$cres=mysql_query($cquery);




?>



	   
		  <div class="widget-block" style="width:70%">
	    	      <div class="widget-head">
						<h5><i class="color-icons user_co"></i>&nbsp;&nbsp;ЗАКАЗЧИК:&nbsp;&nbsp;<?=$row['family'].' '.$row['name'].' '.$row['surname']?></h5>

					</div>
					
					<div class="widget-content">
					
					 <?					 
					    if(mysql_num_rows($cres)>0){
					 ?>
					     <table width="70%" border="1" style="margin:5px 5px 5px 5px">
						 <tr align="center">
						    <td width="25%" rowspan="20" valign="center">
							    <i class="dashboard-icons-colors archives_sl"></i> <span class="dasboard-icon-title">Заказы</span>
							
							</td>
						 
						    <td width="25%"><b>Заказ</b></td>
						    <td width="25%"><b>Дата</b></td>
						    <td width="25%"><b>Закрыт</b></td>
							<td rowspan="20" valign="center">
							     <div class="switch-board-round">
                                  <ul class="clearfix">
							        <li><a href="index.php?page=3&cid=<?=$_SESSION['cid']?>" class="tip-top" title="Новый заказ"><span class="srabon-sprite plus_sl"></span></a></li>
						   		  </ul>
                                </div>
							
							</td>
						 </tr>
						 <?
						   while($crow=mysql_fetch_array($cres)){
						     $ddate=date('d.m.Y',strtotime($crow['contract_date']));
							 $adate=$crow['act_date']==0?'':date('d.m.Y',strtotime($crow['act_date']));
						   	  echo "<tr align='center'>";
							    echo "<td><a href=index.php?page=5&cnid=".$crow['contract_id'].">".$crow['contract_id']."</a></td>";
								echo "<td>".$ddate."</td><td>".$adate."</td>";  
							  echo "</tr>";
						   }
						 ?>
						 </table>
						     
					 <?	
					 }
					 
					 
					 
					 
					 $born= $row['born']>'1910-01-01'?date('d.m.Y',strtotime($row['born'])):'';
					 $pdate = $row['pdate']>'1991-01-01'?date('d.m.Y',strtotime($row['pdate'])):'';
					
					 
					 ?>	
						<div class="widget-box">
							<div class="white-box well">
								
					<form id="custForm" name=custForm method="post" action="lib/f_cust_edit.php" class="form-horizontal well">
				   
				        <fieldset > 
						<div class="control-group">
							<label class="control-label">Фамилия</label>
							<div class="controls" style="float:left">
							   <input type="text" class="span4" name="family"  value="<?=$row['family']?>">
							</div>
						</div>	
						</fieldset>
						<fieldset > 
						 <div class="control-group">
							<label class="control-label">Имя</label>
							<div class="controls" style="float:left">
							  <input type="text" class="span4" name="iname"  value="<?=$row['name']?>">
							</div>  
						 </div>	
						</fieldset>
						
						<fieldset> 
						<div class="control-group">
							<label class="control-label">Отчество</label>
							<div class="controls" style="float:left">
							<input type="text" class="span4"  name="surname"  value="<?=$row['surname']?>">
							</div>  
						 </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Дата рождения</label>
							    <div class="controls" style="float:left">
							       <input type="text" name="born" id="dborn" class="span2" style="text-align:center" value="<?=$born ?>">
							    </div>  
						   </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Место рождения</label>
							    <div class="controls" style="float:left">
							       <input type="text"  name="bplace" class="span4"  value="<?=$row['bplace']?>">
							    </div>  
						   </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Мобильный телефон</label>
							    <div class="controls" style="float:left">
							        <input type="text" name="telmobil" id="telmobil" class="span2" value="<?=$row['telmobil']?>">
							    </div>  
						   </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Электронная почта</label>
							    <div class="controls" style="float:left">
							        <input type="text" name="email" class="span3"  value="<?=$row['email']?>">
							    </div>  
						   </div>	
						</fieldset>
						<hr>
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Паспорт</label>
							    <div class="controls" style="float:left">
							        серия:&nbsp;&nbsp;<input type="text"  class="span1" name="pser" value="<?=$row['pser']?>">&nbsp;&nbsp;
									номер:&nbsp;&nbsp;<input type="text" class="span2" name="pnum"  value="<?=$row['pnum']?>">&nbsp;&nbsp;
									код:&nbsp;&nbsp;<input type="text" class="span1"  name="pkod"  value="<?=$row['pkod']?>" >&nbsp;&nbsp;
							    </div>  
						   </div>	
						</fieldset>
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label"></label>
							    <div class="controls" style="float:left">
							        выдан:&nbsp;&nbsp;<input type="text" class="span4" name="authority"  value="<?=$row['authority']?>">
							    </div>  
						   </div>	
						</fieldset>
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label"></label>
							    <div class="controls" style="float:left">
							        когда:&nbsp;&nbsp; <input type="text" name=pdate id=pdate  class="span2" style="text-align:center"  value="<?=$pdate ?>">
							    </div>  
						   </div>	
						</fieldset>
						<hr>
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Адрес</label>
							    <div class="controls" style="float:left">
							        область:&nbsp;&nbsp;<input type="text" name="adrRegion" class="span4"  value="<?=$row['adrRegion']?>">
							    </div>  
						   </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label"></label>
							    <div class="controls" style="float:left">
							        район:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="adrZone" class="span4" value="<?=$row['adrZone']?>">
							    </div>  
						   </div>	
						</fieldset>		
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label"></label>
							    <div class="controls" style="float:left">
							        населенный пункт:&nbsp;&nbsp;<input type="text" name="adrCity" class="span3" value="<?=$row['adrCity']?>">
							    </div>  
						   </div>	
						</fieldset>	
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label"></label>
							    <div class="controls" style="float:left">
							        улица:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="adrStreet" class="span4"  value="<?=$row['adrStreet']?>">
							    </div>  
						   </div>	
						</fieldset>					
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label"></label>
							    <div class="controls" style="float:left">
							        дом:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="adrHouse" class="span1"  value="<?=$row['adrHouse']?>">&nbsp;&nbsp;&nbsp;&nbsp;
									кв:&nbsp;&nbsp;&nbsp;<input type="text" name="adrFlat" class="span1"  value="<?=$row['adrFlat']?>">
							    </div>  
						   </div>	
						</fieldset>	
						<hr>
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Доп. контакты</label>
							    <div class="controls" style="float:left">
							        Skype:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  class="span2" name="skype"  value="<?=$row['skype']?>">&nbsp;&nbsp;
									ICQ:&nbsp;&nbsp;<input type="text" class="span2" name="icq"  value="<?=$row['ICQ']?>">&nbsp;&nbsp;
									
							    </div>  
						   </div>	
						</fieldset>				

						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Примечание</label>
							    <div class="controls" style="float:left">
							       <input type="text" name="note" class="span6"  value="<?=$row['note']?>">
							    </div>  
						   </div>	
						</fieldset>		
					
						<div class="form-actions" style="padding-left:0">
									<button class="btn btn-primary" type="submit">Сохранить</button>
									<a href="index.php?page=3&cid=<?=$_SESSION['cid']?>" class="btn btn-success"><i class="icon-user icon-white"></i>&nbsp;Создать заказ</a>
									<input type="hidden" name="cid" value="<?=$_SESSION['cid']?>"> 									
						</div>
			  </form>

          
			           </div>
				    </div>
			</div>
		</div>
	

