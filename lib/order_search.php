
<script type="text/javascript">

  jQuery(function($) {
    $.mask.definitions['~']='[+-]';
    $('#df').mask('99.99.9999');
    $('#dt').mask('99.99.9999');
    });

</script>


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
	   
		  <div class="widget-block" style="width:70%">
	    	  <div class="widget-head">
						<h5>ПОИСК ЗАЯВОК</h5>
			  </div>
					
					
					
					<div class="widget-content" >
						<div class="widget-box">
							<div class="white-box well">
								<form method="POST" id="searchForm">
							       
								   <fieldset style="width:40%; float:left;  margin-right: 2%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							           <label>Фамилия заказчика</label>
							           <input type="text" style="width:85%;" name="family" class="required" minlength="2">
						           </fieldset>
						           <fieldset style="width:15%; float:left;  margin-right: 2%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							           <label>№ заявки</label>
							            <input type="text" style="width:85%;" name="order" class="required" minlength="2">
						           </fieldset>
					               <fieldset style="width:40%; float:left;   "> 
							            <label>Дата заявки</label>
						            	с&nbsp; <input type="text" style="width:30%;"  name="df" id="df">&nbsp;&nbsp;&nbsp;
										до&nbsp; <input type="text" style="width:30%;"  name="dt" id="dt">
						           </fieldset>						   
								   <br>
                               
							       	<footer>
									   <input type="hidden" name='search' value=18>
										 <button class="btn btn-primary" type="submit" style="width:15%; margin-top:15px">Найти</button>&nbsp;&nbsp;
										 <a href="index.php?page=1" class="btn btn-success" style="width:15%; margin-top:15px"><i class="icon-user icon-white"></i>&nbsp;Новый заказчик</a>	
										 
			                        </footer>
								</form>	
			              </div>
				</div>
			</div>

		</div><!-- end of post new article -->
		
	  <? 	  
	  if( mysql_num_rows($res) >0 ) 
	  {
	   ?>	

		<div class="widget-block" style="width:70%">
		   	<div class="widget-content" >
				<div class="widget-box">
	    	      <br>
				  <?
				   while($row=mysql_fetch_array($res)){
				   	  echo '<a href=index.php?page=4&cid='.$row['customer_id'].'>'.$row['family'].' '.$row['name'].' '.$row['surname'].'</a>';
					    if(isset($row['contract_id']))
					          echo  '&nbsp;&nbsp;<a href=index.php?page=5&cnid='.$row['contract_id'].'>Заказ №'.$row['contract_id'].' от '.date('d.m.Y',strtotime($row['contract_date'])).'</a>
					  <br>';
				   }
				  ?>
				  <br><br>
				</div>  
			</div>	  
		</div>	  
	<? } ?>	  