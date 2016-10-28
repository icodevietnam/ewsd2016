<?php if(Session::get('user')[0] == null ) { ?>
	<h4>You do not have permission for do the exams</h4>
<?php } 
	else {
?>
<div style="height: 300px;" class="container">

	<br/>
	<h4>Please choose the exams levels:</h4>
	<div class="row">
		<?php 
				foreach ($levels as $key => $value) { 
		?>
			<a style="margin-right: 10px;" class="col s2 btn btn-large teal waves-effect waves-light darken-3" href="<?=DIR;?>test?level=<?= $value->id?>&userId=<?php echo Session::get('user')[0]->id ?>" ><?= $value->name ?></a>
		<?php
			}
		?>
	</div>
	<span class="error"><?= $message ?></span>
</div>

<?php  
	}
?>