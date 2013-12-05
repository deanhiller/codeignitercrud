<?php 
$userId=$id;
$firstName='';
$lastName='';
$email='';
$userName='';

if(isset($this->session->userdata['error'])){
$sessionFlashErr=$this->session->userdata['error'];
}
else{
$sessionFlashErr='';
}
if(isset($this->session->userdata['firstnameerr'])){
$sessionErrfName=$this->session->userdata['firstnameerr'];
}
else{
$sessionErrfName='';
}
if(isset($this->session->userdata['lastnameerr'])){
$sessionErrlName=$this->session->userdata['lastnameerr'];
}
else{
$sessionErrlName='';
}
if(isset($this->session->userdata['emailiderr'])){
$sessionErremail=$this->session->userdata['emailiderr'];
}
else{
$sessionErremail='';
}

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
if(isset($this->session->userdata['fname']))
{
	$firstName=$this->session->userdata['fname'];
}
if(isset($this->session->userdata['lname']))
{
	$lastName=$this->session->userdata['lname'];
}
if(isset($this->session->userdata['email']))
{
	$email=$this->session->userdata['email'];
}
if(isset($this->session->userdata['username']))
{
	$userName=$this->session->userdata['username'];
}

?>

<form class="form-horizontal" style="'min-width:500px;max-width:800px;margin: 0 auto" name="form" method="post" action="<?php echo site_url().'/ourpattern/postUser'; ?>">  
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
	   if($sessionFlashErr!='')
	   {
	   ?>
        <div class="row-fluid">
            <div class="offset3 span6 alert alert-error">
                <h4>Oops....</h4>
                <?php echo $sessionFlashErr; ?>
            </div>
        </div>
       <?php
	   }
	 ?>
    <?php  ?>
        <input type="hidden" name="userid" value="<?php echo $id; ?>"/>  
        <input type="hidden" name="userName" value="<?php echo $userName; ?>"/>
        <div class="control-group">
            <label class="control-label"><a href="#" rel="tooltip" title="Some help message for schema name"><i class="icon-info-sign"></i></a>First Name</label>
            <div class="controls">
                <input id="entityTable" type="text" name="firstname" value="<?php echo $firstName; ?>" class="input-xlarge">
                <span class="help-block" style="color:#FF0000;"><?php echo $sessionErrfName; ?></span>
            </div>
        </div>
        <div class="control-group ${field.errorClass}">
            <label class="control-label"><a href="#" rel="tooltip" title="Some help message for schema name"><i class="icon-info-sign"></i></a>Last Name</label>
            <div class="controls">
                <input id="entityTable" type="text" name="lastname" value="<?php echo $lastName; ?>" class="input-xlarge">
                <span class="help-block" style="color:#FF0000;"><?php echo $sessionErrlName; ?></span>
            </div>
        </div>
        <div class="control-group ${field.errorClass}">
            <label class="control-label"><a href="#" rel="tooltip" title="Some help message for schema name"><i class="icon-info-sign"></i></a>Email</label>
            <div class="controls">
                <input id="entityTable" type="text" name="email" value="<?php echo $email; ?>" class="input-xlarge">
                <span class="help-block" style="color:#FF0000;"><?php echo $sessionErremail; ?></span>
            </div>
        </div>
   </div>
    <div class="modal-footer">
        <input type="submit" name="submit" value="Save" class="btn btn-primary" />
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</form>
<?php
$this->session->unset_userdata('error');
$this->session->unset_userdata('firstnameerr');
$this->session->unset_userdata('lastnameerr');
$this->session->unset_userdata('emailiderr');
$this->session->unset_userdata('fname');
$this->session->unset_userdata('lname');
$this->session->unset_userdata('email');
$this->session->unset_userdata('userName');
?>