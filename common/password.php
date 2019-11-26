<div class="modal fade" id="change-password">
	<form action="<?php echo $base_url; ?>/common/update_password.php" method="POST">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Change Password</h4>
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" name="redirect_url" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
	      	<div class="form-group has-feedback">
			    <input type="password" class="form-control" name="password" placeholder="Current Password" required="required">
			    <span class="glyphicon glyphicon-log-in form-control-feedback" ></span>
			</div>
			<div class="form-group has-feedback">
			    <input type="password" class="form-control" name="new_password" placeholder="Password" required="required">
			    <span class="glyphicon glyphicon-lock form-control-feedback" ></span>
			</div>
			<div class="form-group has-feedback">
			    <input type="password" class="form-control" name="con_password" placeholder="Retype password" required="required">
			    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>

	      </div>
	      <div class="modal-footer">
	        <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary pull-right">Update</button>
	      </div>
	    </div>
	    <!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
  	</form>
</div>
<!-- /.modal -->