<div class="row">
	<div class="col-lg-6">
		<div class="ibox">
			<div class="ibox-content" >
			<h4>Entries without comment</h4>
				<div class="table-responsive">
					<table id="tblFaculty"
							class="table table-bordered table-hover table-striped">
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="ibox">
			<div class="ibox-content">
			<h4>Entries without comment in 14 days</h4>
				<div class="table-responsive">
					<table id="tblPercent"
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