<span class="hidden" id="facultyCode"><?= $facultyCode ?></span>
<span class="hidden" id="facultyName"><?= $facultyName ?></span>
<section id="services">
        <div class="container">
            <div class="row col-md-12">
                <div class="col-md-12 text-center">
                    <h2 class="section-heading"><?= $heading ?></h2>
                    <h3 class="section-subheading text-muted"><?= $entry->description ?></h3>
                </div>
            </div>
            <div class="row">
            	<img class='img-responsive' src="<?= $entry->img ?>" />
            </div>
            <div class="row">
            	<h5 style="color:blue;">Content</h5>
            	<br/>
            	<p><?= $entry->content ?></p>
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
            <?php if($comments != null) { ?>
            <div style="border: 1px dashed #000000;padding-left: 10px ; " id="comment" class="row">
                <h5 style="color:#000000;">Comment</h5>
                    <?php foreach($comments as $comment) {?>
                        <div class="row">
                            <div class="col-md-2">
                                <img class="img-responsive" src="<?= $comment->avatar ?>" />
                                <p class="username"><?= $comment->username ?></p>
                            </div>
                            <div class="col-md-10">
                                <p class="name">Title : <?= $comment->name ?></p>
                                <p class="comment"><?= $comment->comment ?></p>
                                <p style="font-size:11px;" class="created_date"><?= $comment->date_created ?></p>
                            </div>
                        </div>
                    <?php } ?>
            </div>
            <?php } ?>
            <?php } ?>
        </div>
</section>
<?php
Assets::js([
    Url::templateHomePath().'js/page/viewEntry.js'
]);