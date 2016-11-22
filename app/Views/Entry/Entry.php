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
			<form id="reviewEntryForm" class="form-horizontal" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<span class="entryId hidden"></span>
							<span class="entryName"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10">
							<span class="entryDescription"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">Content</label>
						<div class="col-sm-10">
							<span class="entryContent"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">Faculty Code</label>
						<div class="col-sm-10">
							<span class="facultyCode"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">Student</label>
						<div class="col-sm-10">
							<span class="student"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">File</label>
						<div class="col-sm-10">
							<span class="file"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-sm-2 control-label">Comment</label>
						<div class="col-sm-10">
							<textarea class="comment col-sm-12" name="comment"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="checkStatus('approved');" class="btn btn-primary">Approve</button>
					<button type="button" onclick="checkStatus('non_approved');" class="btn btn-danger">None Approve</button>
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