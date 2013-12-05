<div id="content">
	<div class="container"> 
		<div class="content rt">
			<h4><?php echo $title; ?></h4>
			<?php $showPopupSession='';
			if(isset($this->session->userdata['showPopup']))
			{
				$showPopupSession=$this->session->userdata['showPopup'];
			}
			?>
			<div id="addEditPatternModal" class="modal hide <?php if($showPopupSession=='true') { ?>in<?php } ?>" tabindex="-1" role="dialog" data-backdrop="true" aria-labelledby="addEditModalLabel" aria-hidden="<?php if($showPopupSession=='true') { ?>false<?php } else { ?>true<?php } ?>" <?php if($showPopupSession=='true') { ?>style="display: block;"<?php } ?> >
				<?php
				if($showPopupSession=='true')
				{
				$data["id"]=$this->session->userdata['userId'];
				$data["users"]=array();
				
				?>
				<?php $this->load->view('OurPattern/ajaxAddEdit',$data); ?>
				<script type="text/javascript">
				   $(document).ready(function() { 
					   $("#addEditPatternModal").modal('show');   
				   });
				</script>
				<?php
				$this->session->unset_userdata('showPopup');
				}
				?>
			</div>
			<div id="deletePatternModal"></div>
			<table class="table">
				<thead>
					<tr>
						<th>FirstName</th>
						<th>LastName</th>
						<th>Email</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if(count($users)>0)
				{
					foreach($users as $user)
					{
				?>
						<tr>
							<td><?php echo $user->firstname; ?></td>
							<td><?php echo $user->lastname; ?></td>
							<td><?php echo $user->email; ?></td>
							<td>
								<a href="#" data-toggle="modal" class="btn" id="editLink_<?php echo $user->id ?>">Edit</a>
								   <script type="text/javascript">
									 $(document).ready(function() {	
									  var getAddEditPattern=  '<?php echo site_url().'/ourpattern/ajaxAddEdit/'.$user->id; ?>';
										 $("#editLink_<?php echo $user->id ?>").click(function(e){
											 $('#addEditPatternModal').load(getAddEditPattern,function(){
												 $("#addEditPatternModal").modal('show');	
											  });
										 });
									});
									</script>
									&nbsp;
								<a href="#" data-toggle="modal" class="btn" id="deletePattern_<?php echo $user->id ?>">Delete</a>
								   <script type="text/javascript">
										$(document).ready(function() {	
										 var getDeletePattern= '<?php echo site_url().'/ourpattern/ajaxDelete/'.$user->id; ?>';
											$("#deletePattern_<?php echo $user->id; ?>").click(function(e){
												$('#deletePatternModal').load(getDeletePattern,function(){
													 $("#myDeletePattern").modal('show');	
											   });
											});
										});
									</script>
							   </td>
						</tr>
				<?php
					}
				}
				else
				{
				?>
					<tr>
						<td colspan="4">
							There are no users, Add one now please.
						</td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>

			<a href="javaScript:void(0);" class="btn btn-primary" id="addLink">Add User</a>
			<p style="clear: both;">
				<script type="text/javascript">
					$(document).ready(function() {	
						 var getAddEditPattern= '<?php echo site_url().'/ourpattern/ajaxAddEdit/'; ?>';
							$("#addLink").click(function(e){
								$('#addEditPatternModal').load(getAddEditPattern,function(){
									 $("#addEditPatternModal").modal('show');	
							});
						});
					});
				</script>
			</p>
		</div>
	</div>
</div>
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