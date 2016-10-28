<div class="row">
	<div class="col-lg-6">
		<div class="ibox">
			<div class="ibox-content">
				<a href="<?=DIR;?>admin/role" class="btn-link">
					<h2><?= $title ?></h2>
				</a>
				<form id="passwordForm" class="form-horizontal" method="POST">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Old Password</label>
						<input type="text" value="<?= $user[0]->id ?>" class="id hide form-control" name="id" >
						<div class="col-sm-10">
							<input type="password" class="oldPassword form-control" name="oldPassword" >
						</div>
						</div>
						<div class="form-group">
							<label for="description" class="col-sm-2 control-label">New Password</label>
							<div class="col-sm-10">
								<input type="password" class="newPassword form-control" name="newPassword" >
							</div>
						</div>
						<div class="form-group">
							<label for="description" class="col-sm-2 control-label">Confirm Password</label>
							<div class="col-sm-10">
								<input type="password" class="confirmPassword form-control" name="confirmPassword" >
							</div>
						</div>
						<div class="form-group">
							<span class="alert-danger"></span>
						</div>
					<div class="modal-footer">
						<button type="button" onclick="changePasswordForm.changePassword();" class="btn btn-primary">Change Password</button>
					</div>
			</form>
			</div>
		</div>
	</div>
</div>

<?php
Assets::js([
	Url::templatePath().'js/page/change-password-admin.js'
]);
?>