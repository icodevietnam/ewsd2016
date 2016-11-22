<div class="row">
	<div class="col-lg-6">
		<div class="ibox">
			<div class="ibox-content" >
			<h4>Number Of Entries of each faculty</h4>
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
			<div id="chartContainer" style="height: 300px; width: 100%;"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="ibox">
			<div class="ibox-content">
			<h4>Count of contributors</h4>
				<div class="table-responsive">
					<table id="tblContributor"
							class="table table-bordered table-hover table-striped">
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
Assets::js([
	Url::templatePath().'js/page/statistic.js'
]);
?>