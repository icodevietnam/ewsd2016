<section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Entries</h2>
                    <h3 class="section-subheading text-muted">You can create your entries and management it.</h3>
                </div>
            </div>
            <div class="row">
                <div id="entryTab">
                    <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Create Entry</a></li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="row">
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Create Entry</h3>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form id="createEntryForm" role="form" action="" method="post" class="registration-form">
                                        <div class="form-group">
                                            <label class="sr-only" for="name">Name</label>
                                            <input type="text" name="name" placeholder="Name..." class="name form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="description">Description</label>
                                            <textarea name="description" placeholder="Description..." class="name form-control" id="description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="content">Content</label>
                                            <textarea name="content" placeholder="Content..." class="editor content form-control" id="content"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="file" class="sr-only">File</label>
                                            <input type="file" class="file form-control" name="file" placeholder="File..." >
                                            <label id="file-error" class="error" for="file">File is not blank</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="image" class="sr-only">Image</label>
                                            <input type="file" class="image form-control" name="image" placeholder="Image..." >
                                            <label id="image-error" class="error" for="image">Image is not blank</label>
                                            <br/>
                                            <img width="120px" style="margin-top:10px;" class="img-rounded text-right preview" src="http://localhost/ewsd2016/assets/images/no-image.png"  />
                                        </div>
                                        <button type="button" onclick="createEntryForm.create();" class="btn btn-primary">Create Entry</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
</section>
<?php
Assets::js([
    Url::templateHomePath().'js/page/entry.js'
]);