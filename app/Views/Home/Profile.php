<section id="services">
        <div class="container">
            <div class="row col-md-12">
                <div class="col-md-12 text-center">
                    <h2 class="section-heading"><?= $heading ?></h2>
                    <h3 class="section-subheading text-muted">See Your Profile.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">Username</div>
                <div class="col-md-9"><?= Session::get('student')[0]->username ?></div>
                <div class="col-md-3">Full Name</div>
                <div class="col-md-9"><?= Session::get('student')[0]->fullname ?></div>
                <div class="col-md-3">Email</div>
                <div class="col-md-9"><?= Session::get('student')[0]->email ?></div>
                <div class="col-md-3">Faculty</div>
                <div class="col-md-9"><?= $facultyCode ?></div>
                <div class="col-md-3">Avatar</div>
                <div class="col-md-9"><img class="img-responsieve" src="<?= Session::get('student')[0]->avatar ?>"/></div>
            </div>
            <br/>
        </div>
</section>
<?php
