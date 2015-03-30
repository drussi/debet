
<?
     $query='select * from users';
?>

		  <div class="widget-block" style="width:70%">
	    	  <div class="widget-head">
						<h5><i class="color-icons user_business_co"></i>&nbsp;&nbsp;Администрирование пользователей</h5> 
		 	  </div>
					
				<div class="widget-content" >
				   <div class="widget-box">
				     <div class="white-box well">
						<form method="post" class="form-horizontal well">
						   <fieldset > 
						     <div class="control-group">
							     <label class="control-label">Выбрать пользователя</label>
							       <div class="controls" style="float:left">
							          <select  name="user" class="span4">
				                      <option>--------------------------</option>
				                            <?
				                               $result=mysql_query($query);
				                                  while($row=mysql_fetch_array($result)){
				                            	      echo "<option value=".$row['user_id'].">".$row['family']." ".$row['name']." ".$row['surname'];
				                               }
				                            ?>
				                      </select>&nbsp;&nbsp;&nbsp;&nbsp;
									  <button class="btn btn-primary" type="submit"><i class="icon-search icon-white"></i>&nbsp;Найти</button>
									  <a href="index.php?page=6&add=1" class="btn btn-success"><i class="icon-user icon-white"></i>&nbsp;Новый пользователь</a>
						    	</div>
						     </div>	
						  </fieldset>
					   </form>
					  </div> 
			     </div>
			</div>
	    </div>	
					   
   <?
   $user=isset($_POST['user'])?$_POST['user']:$_GET['user'];
    if( $user>0 ) {
	    
   	    $qu="select *  from  users where user_id='".$user."'";
 	    $resu=mysql_query($qu);
 	    $ru=mysql_fetch_array($resu);
 	?>	
	  
	    <div class="nonboxy-widget" style="width:70%"> 
    
		     <div class="widget-content" >
			    <form method="post" action="lib/f_user_edit.php" id="userForm" name="userForm" class="form-horizontal well">
				  <fieldset > 
						<div class="control-group">							
							
							<label class="control-label" style="color:navy; width:60%">
							 <span class="color-icons page_white_edit_co"></span>&nbsp;&nbsp;
							    Редактирование данных пользователя
							</label>
							
						</div>	
						</fieldset>
		
				      <fieldset > 
						<div class="control-group">
							<label class="control-label">Фамилия</label>
							<div class="controls" style="float:left">
							   <input type="text" class="span4" name="family"  value="<?=$ru['family']?>">
							</div>
						</div>	
						</fieldset>
						<fieldset > 
						 <div class="control-group">
							<label class="control-label">Имя</label>
							<div class="controls" style="float:left">
							  <input type="text" class="span4" name="name"  value="<?=$ru['name']?>">
							</div>  
						 </div>	
						</fieldset>
						
						<fieldset> 
						<div class="control-group">
							<label class="control-label">Отчество</label>
							<div class="controls" style="float:left">
							<input type="text" class="span4"  name="surname"  value="<?=$ru['surname']?>">
							</div>  
						 </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Логин</label>
							    <div class="controls" style="float:left">
							       <input type="text" name="login" id="login" class="span4" value="<?=$ru['login']?>">
							    </div>  
						   </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Пароль</label>
							    <div class="controls" style="float:left">
							       <input  id="pass" type="password"  name="pass" class="span4" value="<?=$ru['pass']?>">
							    </div>  
						   </div>	
						</fieldset>
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Пароль (подтверждение)</label>
							    <div class="controls" style="float:left">
							      <input id="pass_confirm"  type="password"  name="pass_confirm" class="span4"  value="<?=$ru['pass']?>">
							    </div>  
						   </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Схема доступа</label>
							    <div class="controls" style="float:left">
							         <select  name="role">
					   	                <option>--------------------------</option>
					  	                  <?
					  	                       $querys='select * from roles';
					  	                       $results=mysql_query($querys);
				                               while($rows=mysql_fetch_array($results)){
				                               $selected='';
				                                 if ($rows['role_id']==$ru['role_id'])  $selected=' selected ';
				                     	          echo "<option value=".$rows['role_id'].$selected." >".$rows['role_name'];
				                               }
					  	                  ?>
					  	              </select>
							    </div>  
						   </div>	
						</fieldset>
						
						<div class="form-actions" style="padding-left:0; padding-bottom:0">
									<button class="btn btn-primary" type="submit" >Сохранить</button>									
									<input type="hidden" name="userid" value="<?=$user ?>"> 									
						</div>
	     
		           
	            </form>		
			</div>		   
		</div>				
	<? } ?>					
			
	  
  <?
    if(  $_GET['add']==1 && !isset($user) ) {
 	?>	
	  
	    <div class="nonboxy-widget" style="width:70%"> 
    
		     <div class="widget-content" >
			    <form method="post" action="lib/f_user_add.php" id="userForm" name="userForm" class="form-horizontal well">
				  <fieldset > 
						<div class="control-group">							
							
							<label class="control-label" style="color:navy; width:60%">
							 <span class="color-icons page_white_edit_co"></span>&nbsp;&nbsp;
							    Новый пользователь
							</label>
							
						</div>	
						</fieldset>
		
				      <fieldset > 
						<div class="control-group">
							<label class="control-label">Фамилия</label>
							<div class="controls" style="float:left">
							   <input type="text" class="span4" name="family" >
							</div>
						</div>	
						</fieldset>
						<fieldset > 
						 <div class="control-group">
							<label class="control-label">Имя</label>
							<div class="controls" style="float:left">
							  <input type="text" class="span4" name="name" >
							</div>  
						 </div>	
						</fieldset>
						
						<fieldset> 
						<div class="control-group">
							<label class="control-label">Отчество</label>
							<div class="controls" style="float:left">
							<input type="text" class="span4"  name="surname" >
							</div>  
						 </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Логин</label>
							    <div class="controls" style="float:left">
							       <input type="text" name="login" id="login" class="span4" >
							    </div>  
						   </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Пароль</label>
							    <div class="controls" style="float:left">
							       <input  id="pass" type="password"  name="pass" class="span4">
							    </div>  
						   </div>	
						</fieldset>
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Пароль (подтверждение)</label>
							    <div class="controls" style="float:left">
							      <input id="pass_confirm"  type="password"  name="pass_confirm" class="span4" >
							    </div>  
						   </div>	
						</fieldset>
						
						<fieldset >
						   <div class="control-group">
						    	<label class="control-label">Схема доступа</label>
							    <div class="controls" style="float:left">
							         <select  name="role">
					   	                <option>--------------------------</option>
					  	                  <?
					  	                       $querys='select * from roles';
					  	                       $results=mysql_query($querys);
				                               while($rows=mysql_fetch_array($results)){
				                     	          echo "<option value=".$rows['role_id']." >".$rows['role_name'];
				                               }
					  	                  ?>
					  	              </select>
							    </div>  
						   </div>	
						</fieldset>
						
						<div class="form-actions" style="padding-left:0; padding-bottom:0">
									<button class="btn btn-primary" type="submit" >Добавить пользователя</button>									
					
						</div>
	     
		           
	            </form>		
			</div>		   
		</div>				
	<? } ?>				