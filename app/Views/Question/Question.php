<div class="row">
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-content">
				<a href="<?=DIR;?>admin/role" class="btn-link">
					<h2>Questions</h2>
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

<div class="answer-table row">
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-content">
				<a href="#" class="btn-link">
					<h2>Answers</h2>
				</a>
				<button data-toggle="modal" data-target="#newItemAnswer"class="btn btn-sm btn-primary">Create</button>
				<div class="table-responsive">
					<table id="tblItemsAnswers"
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
				<h4 class="modal-title" id="myModalLabel">Add Question</h4>
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
							<textarea class="description form-control" name="description" ></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Audio</label>
						<div class="audio-preview col-sm-10">
							<input type="file" class="audio form-control" name="audio" >
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Level</label>
						<div class="col-sm-10">
							<select class='selectpicker level combobox' name='level' data-style='white' data-width="100%">
								<?php 
									foreach ($levels as $key => $value) {
										echo "<option value=".$value->id.">".$value->name."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Point</label>
						<div class="col-sm-10">
							<input type="number" class="point form-control" name="point" >
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
						<h4 class="modal-title" id="myModalLabel">Edit Question</h4>
				</div>
					<form id="updateItemForm" class="form-horizontal" method="POST">
				<div class="modal-body">
					<input type="text" class="id form-control hide" name="id" >
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="name form-control" name="name" >
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10">
							<textarea class="description form-control" name="description" ></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Audio</label>
						<div class="audio-preview col-sm-10">
							<input type="file" class="audio form-control" name="audio" >
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Level</label>
						<div class="col-sm-10">
							<select class='selectpicker level combobox' name='level' data-style='white' data-width="100%">
								<?php 
									foreach ($levels as $key => $value) {
										echo "<option value=".$value->id.">".$value->name."</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Point</label>
						<div class="col-sm-10">
							<input type="number" class="point form-control" name="point" >
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

<div class="modal fade" id="newItemAnswer" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Add Answer</h4>
			</div>
			<form id="newItemAnswerForm" class="form-horizontal" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<input type="text" class="hide questionId form-control" name="questionId" >
						<div class="col-sm-10">
							<input type="text" class="name form-control" name="name" >
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Is Correct</label>
						<div class="col-sm-10">
							<input class="correct form-control" data-off-text="No" data-on-text="Correct" type="checkbox" name="correct" />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="addAns();" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="updateItemAnswer" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Edit Answer</h4>
				</div>
					<form id="updateItemAnswerForm" class="form-horizontal" method="POST">
				<div class="modal-body">
					<input type="text" class="id form-control hide" name="id" >
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<input type="text" class="hide questionId form-control" name="questionId" >
						<div class="col-sm-10">
							<input type="text" class="name form-control" name="name" >
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Is Correct</label>
						<div class="col-sm-10">
							<input class="correct form-control" data-off-text="No" data-on-text="Correct" type="checkbox" name="correct" />
						</div>
					</div>
				</div>
				<div class="modal-footer">
						<button type="button" onclick="updateAns();" class="btn btn-primary">Edit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
Assets::js([
	Url::templatePath().'js/page/question-admin.js'
]);
?>