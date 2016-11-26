<div class="row">
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-content">
				<a href="<?=DIR;?>admin/notification" class="btn-link">
					<h2><?= $title ?></h2>
				</a>
				<div class="table-responsive">
					<table id="tblItems"
							class="table table-bordered table-hover table-striped">
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="viewNotification" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">View Notification</h4>
			</div>
			<form id="notiForm" class="form-horizontal" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-10">
							<span class="notiId hidden"></span>
							<span class="notiTitle"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Content</label>
						<div class="col-sm-10">
							<span class="notiContent"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">Faculty</label>
						<div class="col-sm-10">
							<span class="notiFaculty"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">Created Date</label>
						<div class="col-sm-10">
							<span class="notiCreatedDate"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="read();" class="btn btn-primary">Read</button>
				</div>
			</form>
		</div>
	</div>
</div>


<?php
Assets::js([
	Url::templatePath().'js/page/notification-admin.js'
]);
?>