<div class="row">
	<div class="col-lg-6">
		<div class="ibox">
			<div class="ibox-content">
				<a href="<?=DIR;?>admin/role" class="btn-link">
					<h2><?= $title ?></h2>
				</a>
				<div class="row">
					<div class="col-lg-3"><strong>Total of Question:</strong></div>
					<div class="col-lg-9"><?= $countQuestion[0]->COUNT_NUMBER ?></div>
				</div>
				<div class="row">
					<div class="col-lg-3"><strong>Total of Level:</strong></div>
					<div class="col-lg-9"><?= $countLevel[0]->COUNT_NUMBER ?></div>
				</div>
				<div class="row">
					<div class="col-lg-3"><strong>Total of Examination:</strong></div>
					<div class="col-lg-9"><?= $countExamination[0]->COUNT_NUMBER ?></div>
				</div>
				<div class="row">
					<div class="col-lg-3"><strong>Total of News:</strong></div>
					<div class="col-lg-9"><?= $countNew[0]->COUNT_NUMBER ?></div>
				</div>
			</div>
		</div>
	</div>
</div>