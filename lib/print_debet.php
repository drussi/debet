<?php
 session_start();

   header("Content-Type: application/msword");
   header("Content-disposition: attachment;filename=111.docx");
   
   require_once("../includes/config.php");
   require_once("../includes/conn.php");
  // mysql_select_db('diskus');
   mysql_query("set character_set_results='utf8'"); 	
	
   $hPage=44;
   $nPage=1;
   
   $where='where ';
   
   	if(!empty($_POST['chp_laws']) && $_POST['chp_laws']!=''){
	  $where .= " law_id in (".$_POST['chp_laws'].")";
	}
   
   
     $select = "select l.*, c.account, c.fio, c.house, c.flat, ds.name as status
		from laws l 
		   join contracts c on c.contract_id=l.contract_id
			  join debet_state ds on l.cur_status=ds.state_id 
			    ".$where;
		
	 $res_laws=mysql_query($select);		

   switch($_POST['doc_print']){
 	  case '1': //реестр на госпошлину
	      require_once("../lib/print_gosposhlina.php");
	  break;
	
      case '2': //исковое заявление
	      require_once("../lib/print_isk.php");
	  break;
	
	  default:
	  break;
	
 }

   
?>
