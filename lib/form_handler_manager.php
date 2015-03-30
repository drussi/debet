<?
  
//include("../includes/conn.php");
   // session_start();
   
  $_SESSION['lastTime']=$_SESSION['nowTime'];
  if(empty($_SESSION['lastTime'])) 
       $_SESSION['lastTime']=strtotime("now");
  $_SESSION['nowTime']=strtotime("now");

  if( !empty($_SESSION['lastTime']) && $_SESSION['nowTime']-$_SESSION['lastTime']>$session_max_life){
  	session_destroy();
	header('Location:' . $path.'login.php');
  }	

  $uid=$_SESSION['uid'];
  $accept_array= $_SESSION['accept_array'];

  if(empty($uid)){
   header('Location:'.$path.'login.php');
   }
  
  $page= isset($_POST['page'])?$_POST['page']:$_GET['page'];
  
  $cid=isset($_POST['cid'])?$_POST['cid']:$_GET['cid'];
  $cnid=isset($_POST['cnid'])?$_POST['cnid']:$_GET['cnid'];
  
  if(!isset($_SESSION['cid']) || (isset($cid) &&  $_SESSION['cid']<>$cid)){
  	$_SESSION['cid']  =  $cid ;
  }
 
  if(!isset($_SESSION['cnid']) || (isset($cnid) && $_SESSION['cnid']<>$cnid)){
     $_SESSION['cnid']= $cnid ; 	
  }
	  
   
   if(!isset($page))
	    $content="require_once('lib/debet.php');";
   
   
	  
   if (isset($page) && in_array($page, $accept_array)){
        $query="select file, bread_stack from pages where page_id ='".$page."'";
	    $result=mysql_query($query);
	    $row=mysql_fetch_array($result);		
	    $content="require_once('".$row['file']."');";
		$type=$row['bread_stack'];

		   $value = $type=='cust'?$_SESSION['cid']:$_SESSION['cnid'];
		       
		if(isset($type))
		  setBreadcrumbsStack($type,$value);	
		else 
		  unset($_SESSION['breadcrumbs']);
   }	  
	  
 

    function setBreadcrumbsStack($type, $value){
    	switch($type){
    		case 'cust':
    		     $_SESSION['cid']=$value;
    		     unset($_SESSION['cnid']);
                 unset($_SESSION['flid']);
                 $query="select concat(`family`, concat(' ', concat(substring(name,1,1), concat('. ', concat(substring(surname,1,1),'.'))))) as FIO
                    from customers where customer_id='".$value."'";
                 $result=mysql_query($query);
                 $row= mysql_fetch_array($result);
                 $_SESSION['breadcrumbs']="<a href=\"index.php?page=4&cid=".$value."\">
				    <span class=\"color-icons user_thief_baldie_co\"></span>
				      ".$row['FIO']." </a><div class=\"breadcrumb_divider\"></div>";
    		    break;
    		case 'order':
    		       $query="select c.customer_id, concat(`family`, concat(' ', concat(substring(name,1,1), concat('. ', concat(substring(surname,1,1),'.'))))) as FIO,
                        cn.contract_id
                          from customers c
                            join contracts cn on c.customer_id=cn.customer_id 
                                  where cn.contract_id ='".$value."'";

                 $result=mysql_query($query);
                 $row= mysql_fetch_array($result);
                // echo $query;
                    $_SESSION['cnid']=$value;
    		        $_SESSION['cid']=$row['customer_id'];
    		        

                 $_SESSION['breadcrumbs']="
                     <a href=\"index.php?page=4&cid=".$row['customer_id']."\" class=\"current\">
					 <span class=\"color-icons user_thief_baldie_co\"></span>
					 ".$row['FIO']." </a>
			         >>
			         <a href=\"index.php?page=5&cnid=".$row['contract_id']."\" class=\"current\">
					 <span class=\"color-icons rosette_co\"></span>
					 заказ ".$row['contract_id']." </a>			         
			         ";
    		    break;
    		default:
			   unset($_SESSION['breadcrumbs']);
    		    break;
    	}

    }

      
?>