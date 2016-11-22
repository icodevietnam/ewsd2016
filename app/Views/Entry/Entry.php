<div class="row">
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-content">
				<a href="<?=DIR;?>admin/role" class="btn-link">
					<h2><?= $title ?></h2>
				</a>
				<?php if(Session::get('admin')[0]->roleCode != 'mkcoor') { ?>
				<div class="col-lg-4">
					<select class="form-control" name="faculty" id="faculty" >
						<?php foreach ($faculties as $faculty) { 
							echo "<option value='".$faculty->id."'>".$faculty->code."</option>";
							}
						?>
					</select>
				</div>
				<?php } ?>
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

<div class="modal fade" id="reviewEntry" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Review Entry</h4>
			</div>
			<form id="newItemForm" class="form-horizontal" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="name form-control" name="name" >
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10">
						<input type="text" class="description form-control" name="description" >
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">Code</label>
						<div class="col-sm-10">
						<input type="text" class="code form-control" name="code" >
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">Content</label>
						<div class="col-sm-10">
						<input type="text" class="code form-control" name="code" >
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">Faculty Code</label>
						<div class="col-sm-10">
						<input type="text" class="code form-control" name="code" >
						</div>
					</div>
					</div>
				<div class="modal-footer">
					<button type="button" onclick="" class="btn btn-primary">Approve</button>
					<button type="button" onclick="" class="btn btn-danger">None Approve</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="viewComment" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">View Comment</h4>
			</div>
			<form id="newItemForm" class="form-horizontal" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="name form-control" name="name" >
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10">
						<input type="text" class="description form-control" name="description" >
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">Code</label>
						<div class="col-sm-10">
						<input type="text" class="code form-control" name="code" >
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">Content</label>
						<div class="col-sm-10">
						<input type="text" class="code form-control" name="code" >
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">Faculty Code</label>
						<div class="col-sm-10">
						<input type="text" class="code form-control" name="code" >
						</div>
					</div>
					</div>
				<div class="modal-footer">
					<button type="button" onclick="" class="btn btn-primary">Approve</button>
					<button type="button" onclick="" class="btn btn-danger">None Approve</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
Assets::js([
	Url::templatePath().'js/page/entry-admin.js'
]);
?>