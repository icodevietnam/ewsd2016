</div>

<?php
Assets::js([
	Url::templateLoginPath().'js/jquery-2.1.1.js',
	Url::templateLoginPath().'js/index.js'
]);
echo $js; //place to pass data / plugable hook zone
echo $footer; //place to pass data / plugable hook zone
?>

</body>
</html>
