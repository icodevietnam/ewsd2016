<!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="footer-border"></div>
                        <p>Contribution System. <i>Made by Team</i></p>
                    </div>
                    
                </div>
            </div>
        </footer>

        <!-- Javascript -->
        <?php
            Assets::js([
            Url::templateLoginHomePath().'js/jquery-1.11.1.min.js',
            Url::templateLoginHomePath().'bootstrap/js/bootstrap.min.js',
            Url::templateLoginHomePath().'js/jquery.backstretch.min.js',
            Url::templatePath().'js/jquery.validate.js',
            Url::templateLoginHomePath().'js/page/login.js'
        ]);
        ?>

    </body>

</html>