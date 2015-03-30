<script type="text/javascript">

function checkAll(oForm, cbName, ch)
{
for (var i=0; i < oForm[cbName].length; i++) oForm[cbName][i].checked = ch;
}

</script>

<?php

require_once("../includes/config.php");
require_once("../includes/conn.php");
ini_set(default_charset,"windows-1251");



/*

data: { provider:arr[0],service:arr[1],house:arr[2],fio:arr[3],state:arr[4],dfstatus:arr[5],dtstatus:arr[6],
					        debetf:arr[7],debett:arr[8],dfdebet:arr[9],dtdebet:arr[10],ls:arr[11],dflaw:arr[12],dtlaw:arr[13]},    

*/

   $where='where ';
	 
	if(!empty($_POST['provider']) && $_POST['provider']!=''){
	  $where .= "c.provider_id='".$_POST['provider']."' ";
	}
   
   if(!empty($_POST['service']) && $_POST['service']!=''){
	 $where .= " and l.service_id='".$_POST['service']."' ";
   }
   
    if(!empty($_POST['house']) && $_POST['house']!=''){
	  $house = mb_convert_encoding($_POST['house'],'cp1251','utf8');
	  $where .= " and c.house = '".$house."' ";
    } 
	
	if(!empty($_POST['ls']) && $_POST['ls']!=''){
	  $where .= " and c.account = '".$_POST['ls']."' ";
    } 
	
	if(!empty($_POST['state']) && $_POST['state']!=''){
	     $where .= " and l.cur_status = '".$_POST['state']."'";   
    } 
	
	if(!empty($_POST['dfstatus']) && $_POST['dfstatus']!=''){
	  $where .= " and l.status_date >= '".$_POST['dfstatus']."' ";
    } 
	
	if(!empty($_POST['dtstatus']) && $_POST['dtstatus']!=''){
	  $where .= " and l.status_date < '".$_POST['dtstatus']."' ";
    } 
	
	if(!empty($_POST['debetf']) && $_POST['debetf']!=''){
	  $where .= " and l.law_debet >= '".$_POST['debetf']."' ";
    } 
	
	if(!empty($_POST['debett']) && $_POST['debett']!=''){
	  $where .= " and l.law_debet < '".$_POST['debett']."' ";
    } 
	
	if(!empty($_POST['dfdebet']) && $_POST['dfdebet']!=''){
	  $where .= " and l.cur_date >= '".$_POST['dfdebet']."' ";
    } 
	
	if(!empty($_POST['dtdebet']) && $_POST['dtdebet']!=''){
	  $where .= " and l.cur_date < '".$_POST['dtdebet']."' ";
    } 
	
	if(!empty($_POST['dflaw']) && $_POST['dflaw']!=''){
	  $where .= " and l.jud_date >= '".$_POST['dflaw']."' ";
    } 
	
	if(!empty($_POST['dtlaw']) && $_POST['dtlaw']!=''){
	  $where .= " and l.jud_date < '".$_POST['dtlaw']."' ";
    } 
	
	if(!empty($_POST['fio']) && $_POST['fio']!=''){
	  $fio = mb_convert_encoding($_POST['fio'],'cp1251','utf8');
	  $where .= " and c.fio like '%".$fio."%' ";
    } 
	
	if(!empty($_POST['update']) && $_POST['update']!='' && !empty($_POST['chp_laws']) ){
	    //изменяем состояние элементов
		$update = "update laws set cur_status='".$_POST['state']."', status_date='".date('Y-m-d H:i:s')."'  where law_id in (".$_POST['chp_laws'].")";
		$ru=mysql_query($update);
    } 
	
   
 	    $select = "select l.*, c.account, c.fio, c.house, c.flat, ds.name as status
					  from laws l 
					     join contracts c on c.contract_id=l.contract_id
						 join debet_state ds on l.cur_status=ds.state_id ".$where;

       $res_table=mysql_query($select);
?>
	
	<div id="main-content" style="margin-left:0">
	<div class="container-fluid">
	  <form name="table_form" method="POST"> 
          <div class="row-fluid">
			<div class="span10" style="width:80%; margin-left:10%">
				<div class="nonboxy-widget">
					<table class="table table-bordered" style="background-color:#fff" id=dt0>
					<thead>
					<tr style="background-color:#eee" >
						<th>
							 Л/c
						</th>
						<th>
							 ФИО
						</th>
						<th>
							 Адрес
						</th>
						<th>
							 Состояние
						</th>
						<th>
							 Нач. баланс
						</th>
						<th>
							 Иск. баланс
						</th>
						<th>
							 Тек. баланс
						</th>
						<th>
							 Все&nbsp;&nbsp;<input type="checkbox" onClick="checkAll(this.form,'law[]',this.checked)">
						</th>
						
					</tr>
					</thead>
					 <tbody>
					 <?
					  
					    while($row=mysql_fetch_array($res_table)){
							echo "<tr>";
							 echo "<td>".$row['account']."</td>";
							 echo "<td>".$row['fio']."</td>";
							 echo "<td>".$row['house'].', кв.'.$row['flat']."</td>";
							 echo "<td>".$row['status']."</td>";
							 echo "<td>".$row['start_debet']."</td>";
							 echo "<td>".$row['law_debet']."</td>";
							 echo "<td>".$row['cur_debet']."</td>";
							 echo "<td><input type=\"checkbox\" name=\"law[]\" value='".$row['law_id']."'></td>";
							echo "</tr>";
						}
					 
					 ?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
      </form>
	</div>
</div>



<script src="js/custom-table.js"></script> 


