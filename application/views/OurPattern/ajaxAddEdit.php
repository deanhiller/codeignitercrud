<?php
$userId=$id;
$firstName='';
$lastName='';
$email='';
$userName='';
$cookieFlashErr=get_cookie('error');
$cookieErrfName=get_cookie('errFname');
$cookieErrlName=get_cookie('errLname');
$cookieErremail=get_cookie('errEmail');
if(isset($users))
{
	if(count($users)>0)
	{
		$userName=$users->firstname." ".$users->lastname;
		$firstName=$users->firstname;
		$lastName=$users->lastname;
		$email=$users->email;
	}
}
if(get_cookie('fname')!='')
{
	$firstName=get_cookie('fname');
}
if(get_cookie('lname')!='')
{
	$lastName=get_cookie('lname');
}
if(get_cookie('email')!='')
{
	$email=get_cookie('email');
}
if(get_cookie('userName')!='')
{
	$userName=get_cookie('userName');
}
?>
<form class="form-horizontal" style="'min-width:500px;max-width:800px;margin: 0 auto" method="post" action="<?php echo site_url().'/ourpattern/postUser'; ?>">  
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         <h4 id="myModalLabel"> 
		 <?php
		 if($userId!='')
		 {
		 	echo $userName;
		 }
		 else
		 {
		 	echo 'Add User';
		 }
		 ?>
		 </h4>
    </div>
    <div class="modal-body">
       <?php
	   if($cookieFlashErr!='')
	   {
	   ?>
        <div class="row-fluid">
            <div class="offset3 span6 alert alert-error">
                <h4>Oops....</h4>
                <?php echo $cookieFlashErr; ?>
            </div>
        </div>
       <?php
	   }
	   ?>
    
        <input type="hidden" name="userid" value="<?php echo $id; ?>"/>  
        <input type="hidden" name="userName" value="<?php echo $userName; ?>"/>
        <div class="control-group">
            <label class="control-label"><a href="#" rel="tooltip" title="Some help message for schema name"><i class="icon-info-sign"></i></a>First Name</label>
            <div class="controls">
                <input id="entityTable" type="text" name="firstname" value="<?php echo $firstName; ?>" class="input-xlarge">
                <span class="help-block" style="color:#FF0000;"><?php echo $cookieErrfName; ?></span>
            </div>
        </div>
        <div class="control-group ${field.errorClass}">
            <label class="control-label"><a href="#" rel="tooltip" title="Some help message for schema name"><i class="icon-info-sign"></i></a>Last Name</label>
            <div class="controls">
                <input id="entityTable" type="text" name="lastname" value="<?php echo $lastName; ?>" class="input-xlarge">
                <span class="help-block" style="color:#FF0000;"><?php echo $cookieErrlName; ?></span>
            </div>
        </div>
        <div class="control-group ${field.errorClass}">
            <label class="control-label"><a href="#" rel="tooltip" title="Some help message for schema name"><i class="icon-info-sign"></i></a>Email</label>
            <div class="controls">
                <input id="entityTable" type="text" name="email" value="<?php echo $email; ?>" class="input-xlarge">
                <span class="help-block" style="color:#FF0000;"><?php echo $cookieErremail; ?></span>
            </div>
        </div>
   </div>
    <div class="modal-footer">
        <input type="submit" name="submit" value="Save" class="btn btn-primary" />
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</form>
<?php
delete_cookie("error");
delete_cookie("errFname");
delete_cookie("errLname");
delete_cookie("errEmail");
delete_cookie("fname");
delete_cookie("lname");
delete_cookie("email");
delete_cookie("userName");
?>