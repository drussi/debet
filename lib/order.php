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
    <h2>��� ������������������</h2>
     <h5>������ ������������ ������ � ���������� ������</h5>
     ���:5401373129 <br>
     ��.�����  630015 �.�����������, ��.��������, �.40, �.134, ��.3
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
      <td width="15%" align="center" bgcolor="#eee"><b>��������</b></td>
	  <td width="35%" align="center"><?=$rowcust['family'].' '.$rowcust['name'].' '.$rowcust['surname'] ?></td>
	  <td width="15%" align="center" bgcolor="#eee"><b>�����</b></td>
	  <td align="center"><?=$rowcust['adrStreet'].', �.'.$rowcust['adrHouse'].', ��.'.$rowcust['adrFlat'] ?></td>
   </tr>
   <tr>
      <td width="15%"  align="center" bgcolor="#eee"><b>�������</b></td>
	  <td width="35%"  align="center">����� <?=$rowcust['pser'] ?> � <?=$rowcust['pnum'] ?></td>
	  <td width="15%"  align="center" bgcolor="#eee"><b>���� ������</b></td>
	  <td align="center"> <?=date('d.m.Y',strtotime($rowcust['pdate']))?> </td>
   </tr>
   <tr>
      <td width="15%"  align="center" bgcolor="#eee"><b>��� �����</b></td>
	  <td width="35%" colspan="3"  align="center"><?=$rowcust['authority'] ?></td>
   </tr>
      <tr>
      <td width="15%"  align="center" bgcolor="#eee"><b>��������</b></td>
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
     <h5>������������ ������������ � ���������� �������������</h5>
   </td>
   <td align="right">
     �� ���� ���������
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
      <h4>������� <u> � <?=$rowcontr['contract_id']?> �� <?=date('d.m.Y',strtotime($rowcontr['contract_date']))?>  �.</u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;� ����������� <?=$rowcontr['user_id']?> </h4>
	   <b>��������������� ������ �������� ������������</b>
   </td>
   </tr>
 </table>
 
 <table align="center" width=90% border="1" style="border-collapse: collapse;">
  <tr bgcolor="#eee"  align="center">
    <td width="5%" style="font-weight:bold">
      �
   </td>
    <td width="50%" style="font-weight:bold">
     ������������ ������ (������)
   </td>
    <td width="10%" style="font-weight:bold">
     ���-��
   </td>
    <td width="10%" style="font-weight:bold">
     ��.���
   </td>
    <td width="10%" style="font-weight:bold">
     ����
   </td>
   <td width="10%" style="font-weight:bold">
     �����
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
			echo "<td align=center> ��. </td>";
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
       <b>�����:</b>
   </td>
    
      <td align="center">
     <b><?=$sum ?></b>
   </td>
</tr>
</table>

<table  width=90% align="center">
<tr>
  <td colspan="2">
    <b>����� ������� ��������</b>
  </td>
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">1.</td>	
  <td style="font-size:8px; line-height: 0.9">��������� ����� ������������ ������������ ���������� ������ ������ ����� ����������� ������������  � ������������ � �������������.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">2.</td>	
  <td style="font-size:8px; line-height: 0.9">������ ����� ����������� ������������ ���������� �� ����� ���������� ���� �����-������� ����������� �����.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">3.</td>	
  <td style="font-size:8px; line-height: 0.9">����������� ������������� �������� �� ������ ����� ������������ �� 30 ���� � �� ������������� ������������� � ������������ � ����������� �������. ��� ���� �������� ����������� ���������������� ������ �� �� ���� ��� �������������, ������� ������������ ������� ��� ������ ������������.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">4.</td>	
  <td style="font-size:8px; line-height: 0.9">�������� ������ ��������� ����������������� ������������ ������������ ����������� ��� ������������ � ����������� ������������� �����������.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">5.</td>	
  <td style="font-size:8px; line-height: 0.9">���������� ���������� ��������� ������������ ����������� ������ � ������������� ������������, ���������������� ����������.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">6.</td>	
  <td style="font-size:8px; line-height: 0.9">����������� ������������ ������������ �� ������ ���������, ���������� � �������� � ������ ��� ������� � ��������� �������� � ���� �����-������� �����, ����������� ������ ���������.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">7.</td>	
  <td style="font-size:8px; line-height: 0.9">����������� ����� ��������������� ������ �� ������ ,��������� � ������������ � ������ ���������.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">8.</td>	
  <td style="font-size:8px; line-height: 0.9">������ � ������������ ������������ �������������� � ������������ � ������������ ����������� ����������, � �.� ���� 12.2006-87 �.9.1, ���� � 50377-92 �.2.1.4, ���� � 50936-96, ���� � 50938-96, � �������� ������������ ������ "� ������ ���� ������������". ���� ���������� �� ����� 45 �����.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">9.</td>	
  <td style="font-size:8px; line-height: 0.9">����������� �� ����� ����������� ������������ � ������� ���������� ��� ����������� ����������� ������ �����������, �������� �����-���� ��������� � ������������ ������������, � ������ ������ �����, ������������� ��� ��������� ����������, � ������ ��������� � ��������� ������������ �����������, � ������ ��������� �����, ����� �� ����������������� ��� ����������� ������������� �����������.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">10.</td>	
  <td style="font-size:8px; line-height: 0.9">���������� �� ���������� ����������� ��������� ����� ����������� ������������ ������ � ���������� ���� � ��� ������� ���������� ������������� �������������� ������ ������������ ������������.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">11.</td>	
  <td style="font-size:8px; line-height: 0.9">������������� ���� ��� ��������� ��������� �������� �� ��������.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">12.</td>	
  <td style="font-size:8px; line-height: 0.9">�� ����������� ���������� ��������� ����������� ��������������� �� �����.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">13.</td>	
  <td style="font-size:8px; line-height: 0.9">������������� ��������� �������� ������������� ����� ��� ����� ����� �� ������� ��������. ����������� �� ����� ��������������� �� ���������������� ������������� ��������� �� ������ ��������� �����.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">14.</td>	
  <td style="font-size:8px; line-height: 0.9">��� ��������� � �������� ����������� ����� �������� �������������� ����������, ����������� � ���������� ���� � �������� ��������� � ������������� ����������� � ���������� ������������ ������ ��������.</td> 	
</tr>
<tr>
  <td style="font-size:8px; line-height: 0.9" valign="top">15.</td>	
  <td style="font-size:8px; line-height: 0.9">����������� � ������������ � ����������� ������� � ������������ ������ �� � 152-�� �� 27 ���� 2006 ���� ����� ����� ������������ ����, ��������, � ��������� ������������ ������ ��������� � ������� ����� �������� ���������� ��������, � ����� �� ���������� 3 ��� ����� ��� �����������.</td> 	
</tr>
 <tr>
  <td style="font-size:8px; font-weight:bold; line-height: 0.9" valign="top" colspan="2">� ��������� ��������, ������������� ���������� � ��������.</td>	
</tr>
 </table>
<table  width=90% align="center">
  <tr>
   <td width=50% style="font-size:8px; line-height: 0.9">�������� (������������� ���������)</td>
   <td style="font-size:8px; line-height: 0.9">������������� �����������</td>
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
      <h4>��� �����-������� ����� �� <?=$dt ?> �.</h4>
   </td>
   </tr>
   <tr>
    <td style="font-size:10px;line-height: 15px" >
       �� �����������������, ������������� ����������� ___________________________ � ����� �������, 
	   � �������� (������������� ���������) ___________________________ � ������ �������, ��������� 
	   ��������� ��� � ���, ��� � ������������ � ��������� ��������� ������������ ������� � ������ 
	   ������ ������ �� �������  � ������������ ���������� � ������ ��������. ��������� ������������ 
	   ����������� ���� ��������� � ������������� ������������. � ��������� ������������ � ������, 
	   � ����� � ������������� �����������, �������� ���������� �� ������ �����. �������� ����������� 
	   � ���, ��� ���������� �� ��������� �� �������� ������� ���� ���������� ��� �������������� 
	   ����������� ���������, � ��������� �������. ��� ����������� ����������� ������������ � �������� 
	   � ����������� ����������� ������������ � ������������� � ������ �������� ������������� �������� 
	   ���������� � ������ ������. 	   � �������� ����� � ��������� �������������� ������������ �������� 
	   ��������� �� �����.
    </td>
   </tr>
 </table>
 <table  width=90% align="center">
  <tr>
   <td width=50% style="font-size:8px; line-height: 0.9">�������� (������������� ���������)</td>
   <td style="font-size:8px; line-height: 0.9">������������� �����������</td>
 </tr>
 <tr>
   <td>____________________/__________</td>
   <td>____________________/__________</td>
 </tr>
</table>  
 
</body>
</html>