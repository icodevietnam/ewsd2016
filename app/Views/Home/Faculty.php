<span class="hidden" id="facultyCode"><?= $facultyCode ?></span>
<span class="hidden" id="facultyName"><?= $facultyName ?></span>
<section id="services">
        <div class="container">
            <div class="row col-md-12">
                <div class="col-md-12 text-center">
                    <h2 class="section-heading"><?= $heading ?></h2>
                    <h3 class="section-subheading text-muted">You will see your all entries.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" id="listYear" name="listYear" >
                        <?php 
							foreach ($listYear as $value) {
								echo "<option value=".$value->year.">".$value->year."</option>";
							}
						?>
                    </select>
                </div>
            </div>
            <br/>
            <div id="entry" class="row">
            </div>
        </div>
</section>
<?php
Assets::js([
    Url::templateHomePath().'js/page/faculty.js'
]);