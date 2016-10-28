<div class="container">
	<div class="row">
		<h4>News</h4>
	    <ul class="collapsible" data-collapsible="expandable">
	    	<?php 
				foreach ($notifications as $key => $value) { 
			?>
				<li>
      				<div class="collapsible-header active">
      				<span class='left'><?= $value->title ?></span>
      				<img class="rounded right" style="width: 40px; vertical-align: middle" src="<?= $value->image ?>">
      				</div>
      				<div class="collapsible-body"><p><?= htmlspecialchars_decode($value->content) ?></p></div>
    			</li>
			<?php
				}
			?>
  		</ul>
	</div>
</div>
