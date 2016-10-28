<div class="container">
	<div class="row">
		<h4>Contact Us</h4>
	    <form id="aboutUsForm" class="col s7">
	      <div class="row">
	      	<div class="input-field col s12">
	      		<label for="name" data-error="wrong" data-success="right">Name</label>
          		<input name="name" type="text" >
        	</div>
	      	<div class="input-field col s12">
	      		<label for="email" data-error="wrong" data-success="right">Email</label>
          		<input name="email" type="text" >
        	</div>
	        <div class="input-field col s12">
	        	<label for="message" data-error="wrong" data-success="right">Message</label>
	          	<textarea id="message" name="message" class="materialize-textarea"></textarea>
	        </div>
	        <div class="col s12">
	        	<span class="success col s12"></span>
	        </div>
	        <button type="button" onclick="aboutUsForm.submit();" class="right col s3 btn btn-large teal waves-effect waves-light darken-3">Send Message</button>
	      </div>
	    </form>
	</div>
</div>

<?php
Assets::js([
	Url::templateHomePath().'js/page/about-us.js'
]);
?>