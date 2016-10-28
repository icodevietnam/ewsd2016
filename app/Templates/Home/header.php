<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title><?php echo $title.' - '.SITETITLE;?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?php
    echo $meta;//place to pass data / plugable hook zone
    Assets::css([
        Url::templateHomePath().'css/materialize.min.css',
        Url::templateHomePath().'css/style.css',
    ]);
    echo $css; //place to pass data / plugable hook zone
    ?>

    <?php
        Assets::js([
        Url::templatePath().'js/jquery-2.1.1.js',
        Url::templatePath().'js/moment.js',
        Url::templatePath().'js/tinymce/tinymce.min.js',
        Url::templatePath().'js/tinymce/jquery.tinymce.min.js',
        Url::templatePath().'js/jquery.validate.js'
    ]);
    ?>
</head>
<body>
    <nav class="orange darken-4" role="navigation">
        <div class="nav-wrapper container">
            <?php 
                if(Session::get('user')[0]->username == '')
                {
            ?>
            <ul class="right hide-on-med-and-down">
                <li><a class="sign-in-modal modal-trigger" data-target="signup" >Sign In</a></li>
                <li><a class="sign-up-modal modal-trigger" data-target="signup" >Sign Up</a></li>
            </ul>
            <?php 
                }
            ?>
            <?php 
                if(Session::get('user')[0]->username != '')
                {
            ?>
            <ul class="right">
                <li>
                    <a class="dropdown-button active" data-activates="dropdown2">
                            <img class="circle" style="width: 45px; vertical-align: middle" src="<?php echo Session::get('user')[0]->avatar ?>">
                            <?php echo Session::get('user')[0]->fullname ?>
                    </a>
                    <ul id="dropdown2" class="dropdown-content active" style="white-space: nowrap; position: absolute; top: 56px; left: 1126.59px; opacity: 1; display: block;">     
                        <li style="width: 100%"><a href="<?=DIR;?>logout">Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
            <?php 
                }
            ?>
        </div>
    </nav>
    <nav class="black" role="navigation">
        <div class="nav-wrapper container">
          <a id="white-text logo-container" href="<?=DIR;?>home" class="brand-logo">English Club</a>
          <ul class="right hide-on-med-and-down">
            <li><a href="<?=DIR;?>home">Home</a></li>
            <?php 
                if(Session::get('user')[0]->username != '')
                {
            ?>
            <li><a href="<?=DIR;?>exam">Examination</a></li>
            <li><a href="<?=DIR;?>history">History</a></li>
            <?php 
                }
            ?>
            <li><a href="<?=DIR;?>news">News</a></li>
            <li><a href="<?=DIR;?>notifications">Notifications</a></li>
            <li><a href="<?=DIR;?>about-us">About Us</a></li>
          </ul>

          <ul id="nav-mobile" class="side-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Examination</a></li>
            <li><a href="#">News</a></li>
            <li><a href="#">Notifications</a></li>
            <li><a href="#">About Us</a></li>
          </ul>
          <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
    </nav>