<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Styles -->
		<link rel="stylesheet" href="<?php echo  base_url() ?>/public/css/bootstrap.css"  />
		<link rel="stylesheet" href="<?php echo  base_url() ?>/public/css/theme.css" type="text/css" />
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
		<script src="<?php echo  base_url() ?>/public/javascripts/jquery-1.6.4.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo  base_url() ?>/public/css/custom.css" />

	</head>
	<body>
		<?php $successSesion='';
		if(isset($this->session->userdata['successMessage']))
		{
		?>
			<div class="row-fluid" id="successMsg">
				<div class="offset3 span6 alert alert-success">
					<?php echo $this->session->userdata['successMessage']; ?>
				</div>
			</div>
		<?php
		
		$this->session->unset_userdata('successMessage');
		}
		?>
		<?php $this->load->view($view); ?>
		<script>
		window.onload = function(){
		  setTimeout(function(){
			  if(document.getElementById("successMsg"))
			  {
				 document.getElementById("successMsg").style.display='none';
			  }
		  }, 10000);
		};
		</script>
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="<?php echo  base_url() ?>/public/js/bootstrap.min.js"></script>
		<script src="<?php echo  base_url() ?>/public/js/theme.js"></script>
	</body>
</html>