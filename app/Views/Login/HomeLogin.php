
        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                	
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Contribution System</strong> &amp; Register Forms</h1>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Login to system</h3>
	                            		<p>Enter username/email and password to log on:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-key"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form id="SignInForm" role="form" action="/ewsd2016/login" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="username">Username</label>
				                        	<input type="text" name="username" placeholder="Username..." class="username form-control" id="form-username">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="password">Password</label>
				                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="password">
				                        </div>
				                        <label class="error" for="username"><?= $message ?></label>
				                        <button type="submit" class="btn">Sign in!</button>
				                    </form>
			                    </div>
		                    </div>
	                        
                        </div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                        	
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Sign up now</h3>
	                            		<p>Fill in the form below to get instant access:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form id="registerForm" role="form" action="" method="post" class="registration-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-first-name">Username</label>
				                        	<input type="text" name="username" placeholder="Username..." class="username form-control" id="username">
				                        </div>
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-first-name">Password</label>
				                        	<input type="password" name="password" placeholder="Password..." class="password form-control" id="password">
				                        </div>
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-first-name">Confirm Password</label>
				                        	<input type="password" name="confirmPassword" placeholder="Confirm Password..." class="confirmPassword form-control" id="confirmPassword">
				                        </div>
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-first-name">Full name</label>
				                        	<input type="text" name="fullName" placeholder="Full name..." class="fullName form-control" id="fullName">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-email">Email</label>
				                        	<input type="text" name="email" placeholder="Email..." class="email form-control" id="email">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-email">Email</label>
				                        	<select name="faculty" id="faculty" class="form-control faculty">
				                        		<?php 
													foreach ($faculties as $value) {
														echo "<option value=".$value->id.">".$value->description."</option>";
													}
												?>
				                        	</select>
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-email">Avatar</label>
				                        	<input type="file" name="avatar" placeholder="Avatar..." class="avatar form-control" id="avatar">
				                        	<img width="120px" style="margin-top:10px;" class="img-rounded text-right preview" src="http://localhost/ewsd2016/assets/images/no-image.png"  />
				                        </div>
				                        <button type="button" onclick="signupForm.submit();" class="btn">Sign me up!</button>
				                    </form>
			                    </div>
                        	</div>
                        	
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>