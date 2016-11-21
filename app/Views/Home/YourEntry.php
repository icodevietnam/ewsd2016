<section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><?= $heading ?></h2>
                    <h3 class="section-subheading text-muted">You will see your all entries.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" id="listStatus" name="listStatus" >
                        <option value="<?= STATUS_APPROVED ?>">Approved</option>
                        <option value="<?= STATUS_NON_APPROVED ?>">Non Approved</option>
                        <option value="<?= STATUS_IS_REVIEWED ?>">Reviewd</option>
                        <option value="<?= STATUS_CLOSE ?>">Closed</option>
                    </select>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="table-responsive">
                    <table id="tblEntry"
                            class="table table-bordered table-hover table-striped">
                    </table>
                </div>
            </div>
        </div>
</section>
<?php
Assets::js([
    Url::templateHomePath().'js/page/your-entry.js'
]);