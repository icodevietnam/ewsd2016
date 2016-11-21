<span class="hidden" id="facultyCode"><?= $facultyCode ?></span>
<span class="hidden" id="facultyName"><?= $facultyName ?></span>
<section id="services">
        <div class="container">
            <div class="row col-md-12">
                <div class="col-md-12 text-center">
                    <h2 class="section-heading"><?= $heading ?></h2>
                    <h3 class="section-subheading text-muted"><?= $entry[0]->description ?></h3>
                </div>
            </div>
            <div class="row">
            	<img class='img-responsive' src="<?= $entry[0]->img ?>" />
            </div>
            <div class="row">
            	<h5 style="color:blue;">Content</h5>
            	<br/>
            	<p><?= $entry[0]->content ?></p>
            </div>
            <div class="row">
            	<h5 style="color:blue;">File</h5>
            	<p>
                <?php
                    foreach ($files as $file) {
                        echo "<a style='color:black;' title='".$file->name."' href='".$file->path."'>".$file->name."</a>";
                    }
                ?>   
                </p>
            </div>
            <br/>
            <?php if(Session::get('student')[0] != null) {?>
            <div id="comment" class="row">
                <h6 style="color:#000000;">Comment</h6>
                
            </div>
            <?php } ?>
        </div>
</section>
<?php
Assets::js([
    Url::templateHomePath().'js/page/viewEntry.js'
]);