
<script type="text/javascript">

  jQuery(function($) {
    $.mask.definitions['~']='[+-]';
    $('#ddate').mask('99.99.9999');
    $('#adate').mask('99.99.9999');
    });

</script>

	   
		  <div class="widget-block" style="width:70%">
	    	  <div class="widget-head">
						<h5>НОВЫЙ ЗАКАЗ</h5>
			  </div>
	<?
	
	    $cid=isset($_GET['cid'])?$_GET['cid']:$_SESSION['cid']; 
	    $query="select * from customers where customer_id ='".$cid."'";
	    $result = mysql_query($query);
		$row=mysql_fetch_array($result);
	
	?>				
					
					
					<div class="widget-content" >
					<form method="POST" id="addOrderForm" action="lib/f_order_add.php">
					   Заказчик: <div class=green_text><?=$row['family'].' '.$row['name'].' '.$row['surname'] ?></div>
						<div class="widget-box">
							<div class="white-box well" >
								
							   
						        <fieldset style="width:25%; float:center;  margin-right: 2%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							         <label>Дата заказа</label>
							         <input type="text" style=" text-align:center; width:50%;" value="<?=date('d.m.Y') ?>" name="ddate" id="ddate" class="required" minlength="2">
						        </fieldset>
						       <div class="clear"></div>
								<br>
								<fieldset>
								 <label>Конфигурация оборудования и заявленная неисправность</label>
						          <table width=100% cellpadding=5px>
	                                  <tr>
	                                     <td align="center"><input type="text" name="note" style="width:90%; text-align:center"></td>
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
									  
									    $qs='select * from services s 
										       join services_prices sp on s.service_id=sp.service_id and sp.date_to is null';
										$rs=mysql_query($qs);
											   
									  
									    for($i=1;$i<=5;$i++){ 
										  mysql_data_seek($rs,0);
										
										?>
						               <tr>
 						                  <td>
										        <select name="service[]" style="width:95%">
										          <option value=0></option>   
												  <?
												    while($rows=mysql_fetch_array($rs)){
														echo '<option value='.$rows['service_id'].'>'.$rows['service_name'].'</option>';
													}
												  ?>
										        </select>
										  </td>
							  	          <td ><input type="text"  name="sq[]" style="width:70%;"></td>
										  <td></td>
										  <td></td>
						               </tr>
									   
									   <? } ?>
						           </table>
						        </fieldset>
								
                                <hr>
								
								<fieldset> <!-- to make two field float next to one another, adjust values accordingly -->							      
							         Дата акта выполненных работ:&nbsp;&nbsp; <input type="text" style="width:15%; text-align:center" name="adate" id="adate">
						        </fieldset>
				                <br>
					  		   <footer>
				                  <div class="submit_link">
					                 <button class="btn btn-primary" type="submit">Сохранить</button> &nbsp;&nbsp;		
								     <input type="hidden" name=cid value=<?=$_GET['cid']?>>		
				                  </div>
			                  </footer>
               
			              </div>
			     	</div>
			     </div>
            </form>
		</div><!-- end of post new article -->
	

