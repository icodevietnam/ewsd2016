<?php if(Session::get('user')[0] == null ) { ?>
	<h4>You do not have permission for do the exams</h4>
<?php } 
	else {
?>
<div class="container">
	<span id='questionStr' class='hidden'><?= $questions ?></span>
	<span id='name' class='hidden'><?= $code ?></span>
	<br/>
	<h5 class="col s3">Please do your test:( Total: <?= $total ?> points)</h5>
	<p style="border-bottom: 1px dotted black; ">From : <?= $from ?> - To : <?= $to ?></p>
	<div class="row">
		<form id='testForm'>
		<input type="text" class="hidden questions form-control" name="name" value="<?= $code ?>" />
		<div style="margin-bottom: 100px;padding-bottom: 20px;" class="col s12">
		<!-- 
		<p>
      		<input name="group1" type="radio" id="test1" />
      		<label for="test1">Red</label>
    	</p>
    	<p>
      		<input name="group1" type="radio" id="test2" />
      		<label for="test2">Yellow</label>
    	</p>
    	<p>
      		<input class="with-gap" name="group1" type="radio" id="test3"  />
      		<label for="test3">Green</label>
    	</p>
    	-->

			<?php 
				$i=0;
				foreach ($listId as $key => $value) { 
			?>
				<div class="question-wrapper">
					<strong>Question <?php echo(++$i); ?>:<?= $value->name ?> (Points : <?= $value->point ?> )</strong> 
					<p><?= $value->description ?></p>
					<?php
						if(strpos($value->audio, 'mp3') !== false)
						{
					?>
						<audio controls>
						<source src="<?= $value->audio ?>" type="audio/mpeg">
						</audio>
					<?php
						}
						else if(strpos(strtolower($value->audio),'png') !== false || strpos(strtolower($value->audio),'jpg') !== false || strpos(strtolower($value->audio),'bmp') !== false || strpos(strtolower($value->audio),'jpeg') !== false){
					?>
						<img class="materialboxed" width="200" src="<?= $value->audio ?>">
					<?php
						}
					?>
				</div>
				<div style="border-bottom: 1px dotted black;" id="question-<?= $i ?>" class="answer-wrapper" >
					<input type="text" class="hidden questions form-control" name="questions-<?= $i ?>" value="<?= $value->id ?>" />
				</div>
			<?php
				}
			?>
			<div class="row">
				<!-- <button type="button" style="margin-top: 20px;margin-left: 15px;margin-right: 15px;" class='btn waves-effect waves-light teal lighten-1'>Save</button> -->
				<button id="btnFinish" onclick="TestForm.submit();" type="button" style="margin-top: 20px;" class='btn waves-effect waves-light teal lighten-1'>Finish</button>
			</div>
		</div>
		</form>
	</div>
</div>

<?php  
	}
?>

<?php
Assets::js([
	Url::templateHomePath().'js/page/test-home.js'
]);
?>