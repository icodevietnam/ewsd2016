<div class="row">
	<div class="col-lg-6">
		<div class="ibox">
			<div class="ibox-content">
				<a href="<?=DIR;?>admin/role" class="btn-link">
					<h2><?= $title ?></h2>
				</a>
				<form id="profileForm" class="form-horizontal" method="POST">
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Name</label>
					<input type="text" value="<?= $user[0]->id ?>" class="id hide form-control" name="id" >
					<div class="col-sm-10">
						<input type="text" readOnly="true" value="<?= $user[0]->username ?>" class="username form-control" name="username" >
					</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Fullname</label>
						<div class="col-sm-10">
							<input type="text" value="<?= $user[0]->fullname?>" class="fullname form-control" name="fullname" >
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" value="<?= $user[0]->email ?>" class="email form-control" name="email" >
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Avatar</label>
						<div class="col-sm-10">
							<input type="file" class="avatar form-control" name="avatar" >
							<img width="120px" class="img-rounded preview" src="<?= $user[0]->avatar ?>"  />
						</div>
					</div>
					<div class="form-group">
						<span class="alert-danger"></span>
					</div>
				<div class="modal-footer">
					<button type="button" onclick="changeProfile();" class="btn btn-primary">Change Profile</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>

<?php
Assets::js([
	Url::templatePath().'js/page/change-profile-admin.js'
]);
?>