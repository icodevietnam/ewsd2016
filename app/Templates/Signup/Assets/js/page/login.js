$(function(){

	var registerForm = $('#registerForm');

	registerForm.validate({
		rules : {
			username:{
				required:true,
				remote : {
					url : '/ewsd2016/user/checkUser',
					type : 'GET',
					data : {
						username : function(){
							return $('#registerForm .username').val();
						}
					}
				}
			},
			password:{
				required:true,
				minlength : 5
			},
			confirmPassword : {
				required:true,
				equalTo : '.password'
			},
			fullName:{
				required:true
			},
			birthDate:{
				required : true
			},
			email :{
				required : true,
				remote : {
					url : '/ewsd2016/user/checkEmail',
					type : 'GET',
					data : {
						email : function(){
							return $('#newItemForm .email').val();
						}
					}
				}
			}
		},
		messages : {
			username:{
				required:"Username is not blank",
				remote : "Username is existed."
			},
			password:{
				required:"Password is not blank",
				minlength : "Password is not less than 5 characters."
			},
			confirmPassword : {
				required: 'Confirm Password is not blank' ,
				equalTo : 'Password and confirm password are not the same'
			},
			fullName:{
				required:"Full Name is not blank"
			},
			birthDate:{
				required : "Birth date is not blank"
			},
			email :{
				required : "Email is not blank",
				remote : "Email is existed"
			}
		},
	});

});

function registerStudent(){
	
	var registerForm = $('#registerForm');
	if(registerForm.valid()){
			alert('dep trai');
	}
}