<div class="row">
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-content" >
			<h2>Entries without a comment</h2>
				<div class="table-responsive">
					<table id="tblEntryReport1"
							class="table table-bordered table-hover table-striped">
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-content" >
			<h2>Entries without a comment in 14day</h2>
				<div class="table-responsive">
					<table id="tblEntryReport2"
							class="table table-bordered table-hover table-striped">
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
Assets::js([
	Url::templatePath().'js/page/report.js'
]);
?>