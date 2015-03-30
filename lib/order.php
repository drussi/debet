<?
session_start();
require("../includes/config.php");
require("../includes/conn.php");
?>

<html>

<head>
<meta charset="windows-1251">
<title>Master Service</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Admin Panel Template">
<meta name="author" content="Andrey Poleschuk">
<!-- styles -->
<link href="/css/styles.css" rel="stylesheet">

</head>

<body style="background:white; padding-top:20px; font-family:Arial">
<table align="center" width=90%>
  <tr>
   <td>
    <h2>ООО «МастерСвязьСервис»</h2>
     <h5>УСЛУГИ КОМПЬЮТЕРНОЙ ПОМОЩИ И СЕРВИСНОГО ЦЕНТРА</h5>
     ИНН:5401373129 <br>
     Юр.адрес  630015 г.Новосибирск, ул.Королева, д.40, к.134, оф.3
  </td>
   <td>
     <img src="../img/logo1.png">
  </td>
</tr>
</table>

<?
  $query="select * from customers c where customer_id='".$_SESSION['cid']."'";
  $rescust=mysql_query($query);
  $rowcust=mysql_fetch_array($rescust);
?>

<table align="center" width=90% cellspacing ="4px" border="1" >
    <tr>
      <td width="15%" align="center" bgcolor="#eee"><b>Заказчик</b></td>
	  <td width="35%" align="center"><?=$rowcust['family'].' '.$rowcust['name'].' '.$rowcust['surname'] ?></td>
	  <td width="15%" align="center" bgcolor="#eee"><b>Адрес</b></td>
	  <td align="center"><?=$rowcust['adrStreet'].', д.'.$rowcust['adrHouse'].', кв.'.$rowcust['adrFlat'] ?></td>
   </tr>
   <tr>
      <td width="15%"  align="center" bgcolor="#eee"><b>Паспорт</b></td>
	  <td width="35%"  align="center">серия <?=$rowcust['pser'] ?> № <?=$rowcust['pnum'] ?></td>
	  <td width="15%"  align="center" bgcolor="#eee"><b>Дата выдачи</b></td>
	  <td align="center"> <?=date('d.m.Y',strtotime($rowcust['pdate']))?> </td>
   </tr>
   <tr>
      <td width="15%"  align="center" bgcolor="#eee"><b>Кем выдан</b></td>
	  <td width="35%" colspan="3"  align="center"><?=$rowcust['authority'] ?></td>
   </tr>
      <tr>
      <td width="15%"  align="center" bgcolor="#eee"><b>Контакты</b></td>
	  <td width="35%" align="center"> <?=$rowcust['telmobil'] ?> </td>
	  <td width="15%" align="center" bgcolor="#eee"><b>email</b></td>
	  <td align="center"> <?=$rowcust['email'] ?> </td>
   </tr>
</table>

<?
  $query="select * from contracts cn where contract_id='".$_SESSION['cnid']."'";
  $rescontr=mysql_query($query);
  $rowcontr=mysql_fetch_array($rescontr);


?>


<table align="center" width=90%>
  <tr>
   <td>
     <h5>Конфигурация оборудования и заявленная неисправность</h5>
   </td>
   <td align="right">
     со слов Заказчика
  </td>
</tr>
</table>

<table align="center" width=90% border="1" style="border-collapse: collapse;">
  <tr>
    <td>
     &nbsp; <?=$rowcontr['note'] ?>
   </td>
</tr>

</table>

<table align="center" width=90%>
  <tr>
    <td>
      <h4>ДОГОВОР <u> № <?=$rowcontr['contract_id']?> от <?=date('d.m.Y',strtotime($rowcontr['contract_date']))?>  г.</u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;№ специалиста <?=$rowcontr['user_id']?> </h4>
	   <b>Предоставляемые услуги согласно Прейскуранту</b>
   </td>
   </tr>
 </table>
 
 <table align="center" width=90% border="1" style="border-collapse: collapse;">
  <tr bgcolor="#eee"  align="center">
    <td width="5%" style="font-weight:bold">
      №
   </td>
    <td width="50%" style="font-weight:bold">
     Наименование работы (услуги)
   </td>
    <td width="10%" style="font-weight:bold">
     Кол-во
   </td>
    <td width="10%" style="font-weight:bold">
     Ед.изм
   </td>
    <td width="10%" style="font-weight:bold">
     Цена
   </td>
   <td width="10%" style="font-weight:bold">
     Сумма
   </td>
</tr>
<?
  	    $sqs = "SELECT cs.service_id, cs.quantity, sp.price, sc.service_name
                    FROM contracts_services cs
					    join services sc on sc.service_id=cs.service_id
						join contracts c on cs.contract_id=c.contract_id
                             LEFT JOIN services_prices sp ON cs.service_id = sp.service_id and sp.date_from <=c.contract_date  and (sp.date_to > c.contract_date or  sp.date_to is null )
                                  WHERE cs.contract_id = '".$_SESSION['cnid']."'";   
			$srs=mysql_query($sqs);

		$i=0; $sum=0;
		while($rs=mysql_fetch_array($srs)){
		    $i++;
			echo "<tr>";
			echo "<td align=center>".$i."</td>";
			echo "<td>".$rs['service_name']."</td>";
			echo "<td align=center>".$rs['quantity']."</td>";
			echo "<td align=center> шт. </td>";
			echo "<td align=center>".$rs['price']."</td>";
			echo "<td align=center>".$rs['quantity']*$rs['price']."</td>";
			echo "</tr>";
			$sum+=$rs['quantity']*$rs['price'];
		}	
	   for($j=0;$j<5-$i;$j++){
	    	echo '<tr><td>&nbsp;</td><td>&nbsp;
                  </td><td>&nbsp;</td><td>&nbsp;
			      </td><td>&nbsp;</td><td>&nbsp;
			      </td></tr>';
		    }	
		
?>


<tr>
    <td colspan=5 align="right" bgcolor="#eee">
       <b>Итого:</b>
   </td>
    
      <td align="center">
     <b><?=$sum ?></b>
   </td>
</tr>
</table>

<table  width=90% align="center">
<tr>
  <td colspan="2">
    <b>Общие условия Договора</b>
  </td>
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">1.</td>	
  <td style="font-size:8px; line-height: 0.9">Стоимость услуг определяется специалистом сервисного центра только после диагностики оборудования  в соответствии с Прейскурантом.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">2.</td>	
  <td style="font-size:8px; line-height: 0.9">Оплата услуг Исполнителя производится Заказчиком по факту подписания Акта сдачи-приемки выполненных работ.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">3.</td>	
  <td style="font-size:8px; line-height: 0.9">Исполнитель предоставляет гарантию на ремонт узлов оборудования до 30 дней и на установленные комплектующие в соответствии с гарантийным талоном. При этом гарантия Исполнителя распространяется только на те узлы или комплектующие, которые подвергались ремонту или замене Исполнителем.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">4.</td>	
  <td style="font-size:8px; line-height: 0.9">Заказчик обязан проверить работоспособность настроенного программного обеспечения или оборудования в присутствии представителя Исполнителя.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">5.</td>	
  <td style="font-size:8px; line-height: 0.9">Специалист производит установку программного обеспечения только с лицензионного дистрибутива, предоставляемого Заказчиком.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">6.</td>	
  <td style="font-size:8px; line-height: 0.9">Гарантийное обслуживание производится по адресу Заказчика, указанному в Договоре и только при наличии у Заказчика Договора и Акта сдачи-приемки работ, подписанных обеими сторонами.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">7.</td>	
  <td style="font-size:8px; line-height: 0.9">Исполнитель несет ответственность только за услуги ,оказанные в соответствии с данным Договором.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">8.</td>	
  <td style="font-size:8px; line-height: 0.9">Ремонт и обслуживание оборудования осуществляются в соответствии с требованиями нормативных документов, в т.ч ГОСТ 12.2006-87 п.9.1, ГОСТ Р 50377-92 п.2.1.4, ГОСТ Р 50936-96, ГОСТ Р 50938-96, и согласно Федеральному закону "О защите прав потребителей". Срок исполнения не более 45 суток.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">9.</td>	
  <td style="font-size:8px; line-height: 0.9">Исполнитель не несет гарантийных обязательств в случаях отсутствия или повреждения гарантийной пломбы Исполнителя, внесения каких-либо изменений в конфигурацию оборудования, в случае замены узлов, комплектующих или расходных материалов, в случае установки и настройки программного обеспечения, в случае монтажных работ, работ по администрированию без присутствия представителя Исполнителя.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">10.</td>	
  <td style="font-size:8px; line-height: 0.9">Требования по устранению недостатков оказанных услуг принимаются Исполнителем только в письменном виде и при условии выполнения установленных производителем правил эксплуатации оборудования.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">11.</td>	
  <td style="font-size:8px; line-height: 0.9">Установленные узлы или расходные материалы возврату не подлежат.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">12.</td>	
  <td style="font-size:8px; line-height: 0.9">За сохранность информации Заказчика Исполнитель ответственности не несет.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">13.</td>	
  <td style="font-size:8px; line-height: 0.9">Представитель Заказчика является ответственным лицом при сдаче работ по данному Договору. Исполнитель не несет ответственности за некомпетентность представителя заказчика по оценке оказанных услуг.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">14.</td>	
  <td style="font-size:8px; line-height: 0.9">Все изменения к Договору оформляются путем принятия дополнительных соглашений, оформленных в письменном виде с подписью Заказчика и представителя Исполнителя и являющихся неотъемлемой частью Договора.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">15.</td>	
  <td style="font-size:8px; line-height: 0.9">Исполнитель в соответствии с Федеральным законом о персональных данных РФ № 152-ФЗ от 27 июля 2006 года имеет право осуществлять сбор, хранение, и обработку персональных данных Заказчика в течении срока действия настоящего Договора, а также на протяжении 3 лет после его расторжения.</td> 	
</tr>
 <tr>
  <td style="font-size:8px; font-weight:bold; line-height: 0.9" valign="top" colspan="2">С условиями договора, прейскурантом ознакомлен и согласен.</td>	
</tr>
 </table>
<table  width=90% align="center">
  <tr>
   <td width=50% style="font-size:8px; line-height: 0.9">Заказчик (представитель Заказчика)</td>
   <td style="font-size:8px; line-height: 0.9">Представитель Исполнителя</td>
 </tr>
 <tr>
   <td>____________________/__________</td>
   <td>____________________/___________</td>
 </tr>
</table>  
<table align="center" width=90%>
  <tr>
    <td>
	 <?
	    $dt = $rowcontr['act_date']>'1980-01-01' ? date('d.m.Y',strtotime($row['act_date'])):'_____________';
	 ?>
      <h4>Акт сдачи-приемки работ от <?=$dt ?> г.</h4>
   </td>
   </tr>
   <tr>
    <td style="font-size:10px;line-height: 15px" >
       Мы нижеподписавшиеся, представитель Исполнителя ___________________________ с одной стороны, 
	   и Заказчик (представитель Заказчика) ___________________________ с другой стороны, составили 
	   настоящий Акт о том, что в соответствии с настоящим Договором Исполнителем оказаны в полном 
	   объеме услуги по ремонту  и обслуживанию указанного в данном Договоре. Установка программного 
	   обеспечения была выполнена с лицензионного дистрибутива. С условиями обслуживания и оплаты, 
	   а также с Прейскурантом Исполнителя, Заказчик ознакомлен до начала работ. Заказчик соглашается 
	   с тем, что информация об оказанных по Договору услугах была разъяснена ему представителем 
	   Исполнителя полностью, и Заказчику понятна. Вся необходимая техническая документация и носитель 
	   с прилагаемым программным обеспечением к установленным в рамках Договора комплектующим получены 
	   Заказчиком в полном объеме. 	   К качеству услуг и состоянию обслуживаемого оборудования Заказчик 
	   претензий не имеет.
    </td>
   </tr>
 </table>
 <table  width=90% align="center">
  <tr>
   <td width=50% style="font-size:8px; line-height: 0.9">Заказчик (представитель Заказчика)</td>
   <td style="font-size:8px; line-height: 0.9">Представитель Исполнителя</td>
 </tr>
 <tr>
   <td>____________________/__________</td>
   <td>____________________/__________</td>
 </tr>
</table>  
 
</body>
</html>