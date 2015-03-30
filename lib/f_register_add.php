<?php

session_start();
require_once("../includes/config.php");
require_once("../includes/conn.php");

$provider=$_POST['provider'];
$service=$_POST['service'];
//$rdate= STR_TO_DATE($_POST['rdate'], '%d.%m.%Y') ;
$rdate= $_POST['rdate'];
$rname=$_POST['rname'];

$query_ins = "insert into registries( provider_id, service_id, rdate, rname) 
     values('$provider','$service','$rdate','$rname')";
$res=mysql_query($query_ins);
$rid=mysql_insert_id();

if(isset($rid)){
	 $query_service="select * from services where service_id='$service'";
	 $res_service=mysql_query($query_service);
	 $row_service=mysql_fetch_array($res_service);
	 $format_register=$row_service['format_register'];
	 $format_date=$row_service['format_date'];
	 if( isset($format_register)){
	 	$arr_format=explode(';',$format_register);
		   $date=date('dmY_His');
           $register_file=$_FILES['register_file']['name'];
           if($register_file!=null && $register_file!="none"){
                 $ipath = "Z:\\home\\localhost\\www\\ops\\files\\";
                 $reg_filename=$ipath.$_POST['provider'].'_'.$_POST['service'].'_'.$date.'.txt';
                 copy($_FILES['register_file']['tmp_name'],$reg_filename);
	             $file = @fopen($reg_filename, "r");
                 if ($file) {
                    while (($buffer = fgets($file)) !== false) {
	                    $arr_contract=explode(';',$buffer);
						$account= $arr_contract[array_search('account',$arr_format)];
						$debet = $arr_contract[array_search('debet',$arr_format)];
						$normativ = $arr_contract[array_search('normativ',$arr_format)];
						$last_month=$arr_contract[array_search('last_month',$arr_format)];
						if(isset($last_month) && isset($format_date) ){
							$last_month=date_create_from_format($format_date, $last_month);
						    $last_month = $last_month->format('Y-m-d');
						}						
						$fio = $arr_contract[array_search('fio',$arr_format)];
						$phone = $arr_contract[array_search('phone',$arr_format)];
						$house = $arr_contract[array_search('house',$arr_format)];
						$flat = $arr_contract[array_search('flat',$arr_format)];
						
						$qic="INSERT INTO  `ops`.`register_data` (
                                  `register_id`,
                                  `account`,
                                  `debet`,
                                  `normativ`,
                                  `last_month`,
                                  `fio`,
                                  `phone`,
                                  `house`,
                                  `flat` 
                              )
                              VALUES (
                                   '$rid', '$account',  '$debet',  '$normativ', '$last_month' , '$fio' ,  '$phone', '$house' ,'$flat'
                              )";
						$res_ic=mysql_query($qic);
											
						/* Обновляем таблицу договоров  */
						
						$select_contract = "select * from contracts where provider_id='$provider' and account='$account'";
						$res_contract = mysql_query($select_contract);
						 if(mysql_num_rows($res_contract)>0){
							 $contract=mysql_fetch_array($res_contract);
							 $cid=$contract['contract_id'];
						 }
						 else{
						    	$insert_contract = "INSERT INTO `ops`.`contracts` (`provider_id`, `account`, `fio`, `house`, `flat`, `phone`) 
								VALUES ( '$provider', '$account', '$fio', '$house', '$flat', '$phone')";
								$res_contract = mysql_query($insert_contract);
								$cid=mysql_insert_id();
						 }
						 
						 /* Обновляем таблицу делопроизводств  */
						 
						 $select_law = "select * from laws where contract_id='$cid' and closed='0'";
						 $res_law = mysql_query($select_law);
						 if(mysql_num_rows($res_law)>0){
							 $law=mysql_fetch_array($res_law);
							 switch ($law['cur_status']){
							 	case 1: // начальный статус - обновляем исковой и текущий балансы
								    $update = "update laws set law_date = '$last_month', 
                                                              law_debet = '$debet', 
                                                              law_register_id = '$rid', 
                                                              cur_date = '$last_month', 
                                                              cur_debet = '$debet', 
                                                              cur_register_id = '$rid' 
											 where law_id ='".$law['law_id']."' ";
									$res_upd = mysql_query($update);
								break;
								
								case 2: // оплачена госпошлина - обновляем исковой баланс, если новый баланс меньше старого, и текущий баланс - в любом случае
								    $debet=$debet<$law['law_debet']?$debet:$law['law_debet'];
									$rid=$debet<$law['law_debet']?$rid:$law['law_register_id'];
									$last_month=$debet<$law['law_debet']?$last_month:$law['law_date'];
									$update = "update laws set law_date = '$last_month', 
                                                              law_debet = '$debet', 
                                                              law_register_id = '$rid', 
                                                              cur_date = '$last_month', 
                                                              cur_debet = '$debet', 
                                                              cur_register_id = '$rid' 
											 where law_id ='".$law['law_id']."' ";
									$res_upd = mysql_query($update);
								break;
								
								default: // во всех остальных случаях обновляем только текущий баланс
								    $update = "update laws set cur_date = '$last_month', 
                                                               cur_debet = '$debet', 
                                                               cur_register_id = '$rid' 
											 where law_id ='".$law['law_id']."' ";
									$res_upd = mysql_query($update);
								  
								break;
								
								
							 }
						 }
						 else{
						       $ldate=date('Y-m-d');
						    	$insert_law = "INSERT INTO `ops`.`laws` ( `contract_id`, 
								                                          `service_id`, 
								                                          `ldate`, 
																		  `start_date`, 
																		  `start_debet`, 
																		  `start_register_id`, 
																		  `law_date`, 
																		  `law_debet`, 
																		  `low_register_id`, 
																		  `cur_date`, 
																		  `cur_debet`, 
																		  `cur_register_id`,
																		  `status_date`) 
								VALUES ( '$cid', '$service', '$ldate', '$last_month', '$debet', '$rid', 
								'$last_month', '$debet', '$rid', '$last_month', '$debet', '$rid', '$ldate')";
								$res_ins = mysql_query($insert_law);
						 }						 
	                } // while
	             } // if save on server file register exist
	         }  // if format register exist
       }   // if file register uploaded
  }  // if register exist
   header("Location:".$path."index.php?page=11");

?>