<form class="form-horizontal" style="'min-width:500px;max-width:800px;margin: 0 auto" method="post" action="<?php echo site_url().'/ourpattern/postDelete'; ?>">  
     <div id="myDeletePattern" class="modal hide" data-backdrop="true" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="deleteModalLabel" aria-hidden="true">
       <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           <h4 id="myModalLabel"><?php echo $users->firstname." ".$users->lastname; ?></h4>
       </div>
           <input   type="hidden" name="userid" value="<?php echo $id; ?>"/>  
  	<div id="deletePattern_content" class="modal-body">
         <p>
             Are you sure you want to delete "<?php echo $users->email; ?>" ?
    </p>
	   </div>
		<div class="modal-footer">
		    <input type="submit" name="delete" value="delete" class="btn btn-primary" />
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
	  </div>
</form>