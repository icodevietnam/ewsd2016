<div class="row">
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-content">
				<a href="<?=DIR;?>admin/role" class="btn-link">
					<h2><?= $title ?></h2>
				</a>
				<button data-toggle="modal" data-target="#newItem"class="btn btn-sm btn-primary">Create</button>
				<div class="table-responsive">
					<table id="tblItems"
							class="table table-bordered table-hover table-striped">
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="newItem" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Add Notification</h4>
			</div>
			<form id="newItemForm" class="form-horizontal" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-9">
							<input type="text" class="title form-control" name="title" >
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Description</label>
						<div class="col-sm-9">
							<input type="text" class="description form-control" name="description" >
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Content</label>
						<div class="col-sm-9">
							<textarea name="content" class="content editor"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Image</label>
						<div class="col-sm-9">
							<input type="file" class="image form-control" name="image" >
							<img width="120px" class="img-rounded preview1" src="http://localhost/cat-prj/assets/images/default.png"  />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="insertItem();" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="updateItem" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Edit Notification</h4>
				</div>
				<form id="updateItemForm" class="form-horizontal" method="POST">
				<div class="modal-body">
					<input type="text" class="id form-control hide" name="id" >
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-9">
							<input type="text" class="title form-control" name="title" >
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Description</label>
						<div class="col-sm-9">
							<input type="text" class="description form-control" name="description" >
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Content</label>
						<div class="col-sm-9">
							<textarea id='content2' name='content' class="content editor"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Image</label>
						<div class="col-sm-9">
							<input type="file" class="image form-control" name="image" >
							<img width="120px" class="img-rounded preview2" src="http://localhost/cat-prj/assets/images/default.png"  />
						</div>
					</div>
				</div>
				<div class="modal-footer">
						<button type="button" onclick="update();" class="btn btn-primary">Edit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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