
<script type="text/javascript">

  jQuery(function($) {
    $.mask.definitions['~']='[+-]';
    $('#ddate').mask('99.99.9999');
    $('#adate').mask('99.99.9999');
    });


  function printOrder()
  {
       document.addOrderForm.action = 'lib/order.php';
	 //  window.open('','formwindow','width=400,height=200, location=no,toolbar=no,menubar=no,status=no,scroll bars=yes,resizable=yes');
	   document.addOrderForm.submit();
  };

</script>

 <div class="widget-block" style="width:70%">
   
   	  
	  
	<?
	    $query="select c.customer_id, c.family, c.name, c.surname, cn.*, 
		    concat(u.family, concat(' ', concat(substring(u.name,1,1), concat('. ', concat(substring(u.surname,1,1),'.'))))) as manager
		   from customers c
		  join  contracts cn on cn.customer_id=c.customer_id
		   left join users u on u.user_id=cn.user_id
		    where contract_id ='".$_SESSION['cnid']."'";
	    $result = mysql_query($query);
		$row=mysql_fetch_array($result);
	
	?>
	   
	
	    	  <div class="widget-head">
						<h5>ЗАКАЗ № <?=$row['contract_id']?> </h5>
		     </div>
				
					
					
					<div class="widget-content" >
					<form method="POST" id="addOrderForm" name="addOrderForm" action="lib/f_order_edit.php">
					   Заказчик: <div class=green_text><?=$row['family'].' '.$row['name'].' '.$row['surname'] ?></div>
						<div class="widget-box">
							<div class="white-box well">
								
							    <fieldset style="width:32%; float:left;  margin-right: 2%;">
							        <label>№ заказа</label>
						     	    <input disabled="1" type="text" style="width:50%; text-align:center" name="order" class="required" minlength="2" value="<?=$row['contract_id'] ?>">
						        </fieldset>
						        <fieldset style="width:32%; float:left;  margin-right: 2%;"> 
							         <label>Дата заказа</label>
							         <input type="text" style="width:50%; text-align:center" name="ddate" id="ddate" class="required" minlength="2" value="<?=date('d.m.Y',strtotime($row['contract_date']))?>">
						        </fieldset>
						        <fieldset style="width:31%; float:left;"> 
							         <label>Специалист</label>
							         <input disabled="1" type="text" style="width:60%; text-align:center"  name="user"  value="<?=$row['manager']?>">
						        </fieldset><div class="clear"></div>
								<br>
								<fieldset>
								 <label>Конфигурация оборудования и заявленная неисправность</label>
						          <table width=100% cellpadding=5px>
	                                  <tr>
	                                     <td align="center"><input type="text" name="note" style="width:90%; text-align:center" value="<?=$row['note']?>"></td>
	                                  </tr>	                    
						          </table>
						         </fieldset>
								<br>
								<fieldset >
							     <label style="width:95%;">Услуги, предоставляемые  согласно Прейскуранту</label>
						          <table width=70% cellpadding=5px border="1">
								      <tr align="center">
									     <td width=45% style="font-weight:bold; font-style:italic">Наименование услуги</td>
										 <td width=15% style="font-weight:bold; font-style:italic">Количество</td>
										 <td style="font-weight:bold; font-style:italic">Цена</td>
										 <td style="font-weight:bold; font-style:italic">Сумма</td>
									  </tr>
									  
									  
									  <? 
									  
									    $qs='select * from services s';
										$rs=mysql_query($qs);
										
										$sqs = "SELECT cs.service_id, cs.quantity, sp.price
                                                 FROM contracts_services cs
												   join contracts c on cs.contract_id=c.contract_id
                                                    LEFT JOIN services_prices sp ON cs.service_id = sp.service_id and sp.date_from <=c.contract_date  and (sp.date_to > c.contract_date or  sp.date_to is null )
                                                       WHERE cs.contract_id = '".$_SESSION['cnid']."'";   
										$srs=mysql_query($sqs);
										$snum=mysql_num_rows($srs);	   
									  
									  for($i=1;$i<=5;$i++){ 
										  mysql_data_seek($rs,0);
										  if($i<=$snum){
										     mysql_data_seek($srs, $i-1);
											 $srow=mysql_fetch_array($srs);	
										  }
										  else 
										   $srow=array('service_id'=>0, 'quantity'=>0, 'price'=>0);
										
										?>
						               <tr>
 						                  <td>
										        <select name="service[]" style="width:95%">
										          <option value=0></option>   
												  <?
												    while($rows=mysql_fetch_array($rs)){
													   $sel=$rows['service_id']==$srow['service_id']?' selected ':'';
														echo '<option value='.$rows['service_id'].' '.$sel.'>'.$rows['service_name'].'</option>';
													}
												  ?>
										        </select>
										  </td>
							  	          <td ><input type="text"  name="sq[]" style="width:70%;" value="<?=$srow['quantity']?>"></td>
										  <td><?=$srow['price']?> руб.</td>
										  <td><?=$srow['price']*$srow['quantity']?> руб.</td>
						               </tr>
									   
									   <? } ?>
						           </table>
						        </fieldset>
								
                                <hr>
								
								<fieldset> <!-- to make two field float next to one another, adjust values accordingly -->
							          <?
									    $dt = $row['act_date']>'1980-01-01' ? date('d.m.Y',strtotime($row['act_date'])):'';
									  ?>
							         Дата акта выполненных работ: <input type="text" style="width:15%; text-align:center" name="adate" id="adate" value="<?=$dt ?>">
						        </fieldset>
				                <br>
					  		   <footer>
				                  <div class="submit_link">
								      <input type="hidden" name="cnid" value="<?=$_SESSION['cnid']?>">
					                  <button class="btn btn-primary" type="submit">Сохранить</button>&nbsp;&nbsp;	
									  <button class="btn btn-success" onclick="printOrder()"><i class="icon-print icon-white"></i>&nbsp;Распечатать договор</button>
				                  </div>
			                  </footer>               
			         </div>
				</div>
			</div>

		</div><!-- end of post new article -->
	

