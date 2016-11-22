<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title.' - '.SITETITLE;?></title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <?php
        echo $meta;//place to pass data / plugable hook zone
        Assets::css([
            Url::templateHomePath().'vendor/bootstrap/css/bootstrap.min.css',
            Url::templateHomePath().'vendor/font-awesome/css/font-awesome.min.css',
            Url::templateHomePath().'css/agency.min.css',
        ]);
        echo $css; //place to pass data / plugable hook zone
    ?>

    <?php
        Assets::js([
        Url::templatePath().'js/jquery-2.1.1.js',
        Url::templatePath().'js/moment.js',
        Url::templatePath().'js/tinymce/tinymce.min.js',
        Url::templatePath().'js/tinymce/jquery.tinymce.min.js',
        Url::templatePath().'js/jquery.dataTables.js',
        Url::templatePath().'js/dataTables.bootstrap.js',
        Url::templatePath().'js/jquery.validate.js',
        Url::templatePath().'js/bootstrap.min.js',
        Url::templateHomePath().'js/jqBootstrapValidation.js',
        Url::templateHomePath().'js/contact_me.js',
        Url::templateHomePath().'js/agency.min.js',
        ]);
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <script>
        tinymce.init({
            selector: ".editor",
            statusbar: false,
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            }
        });
    </script>

</head>
<body id="page-top" class="index">
<!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top" style="background-color: #222;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="<?= DIR ?>home"><?= HOMENAME ?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?= DIR ?>home">Home</a>
                    </li>
                    <?php 
                        foreach ($listFaculties as $faculty) {
                            echo "<li><a class='page-scroll' title='".$faculty->description."' href='".DIR."contribute/".$faculty->code."'>".$faculty->name."</a></li>";
                        }
                    ?>
                    <?php  if(Session::get('student') ==null ){ ?>
                    <li>
                        <a class="page-scroll" href="<?= DIR ?>user/login">Login</a>
                    </li>
                    <?php } else{ ?>
                    <li>
                        <a class="page-scroll" href="/ewsd2016/profile" >Hi, [ <?= Session::get('student')[0]->username ?> ] </a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?= DIR ?>your-entry" >Your Entries</a>
                    </li> 
                    <li>
                        <a class="page-scroll" href="<?= DIR ?>contact-us">Contact Us</a>
                    </li>
                    <li>
                    <a class="page-scroll" href="<?= DIR ?>logout" ><u>Log Out</u></a>
                    </li>    
                    <li>
                        <a class="page-scroll btn btn-sm btn-primary" href="<?= DIR ?>create-entry" >Create Entry</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header style="background-image: url(<?= $banner ?>);">
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in"><?= $lead ?></div>
                <div class="intro-heading"><?= $slogan ?></div>
            </div>
        </div>
    </header>