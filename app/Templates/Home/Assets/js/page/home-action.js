;$(function(){
	var form = $("#signupForm");

	form.validate({
		rules:{
			username : {
				required : true,
				remote : {
					url : '/cat-prj/user/checkUser',
					type : 'GET',
					data : {
						username : function(){
							return $('#signupForm .username').val();
						}
					}
				}
			},
			password : {
				required : true,
				minlength : 5
			},
			confirmPassword : {
				required : true,
				equalTo : '.password'
			},
			email : {
				required : true,
				remote : {
					url : '/cat-prj/user/checkEmail',
					type : 'GET',
					data : {
						email : function(){
							return $('#signupForm .email').val();
						}
					}
				}
			},
			fullname : {
				required : true
			},
			birthDate : {
				required : true
			}
		},
		messages:{
			username : {
				required : "Username is not blank",
				remote : "Username is existed."
			},
			password : {
				required : "Password is not blank",
				minlength : "Password is not less than 5 characters."
			},
			confirmPassword : {
				required : "Confirm Password is not blank",
				equalTo : 'Password and confirm password are not the same'
			},
			email : {
				required : "Email is not blank",
				remote : "Email is existed"
			},
			fullname : {
				required : "Full name is not blank"
			},
			birthDate : {
				required : "Birthdate is not blank"
			}
		}
	});

});

var signupForm = {
	submit : function(){
		var form = $('#signupForm');
		var formData =  new FormData(form[0]);
		if(form.valid()){
			$.ajax({
			url : "/cat-prj/user/createStudent",
			type : "POST",
			data : formData,
			contentType : false,
			processData : false,
			dataType : "JSON",
			success : function(response) {
				$('.success').html('Create User Successfully. Please Login !!!');
				$('#signupForm .username').val('');
				$('#signupForm .password').val('');
				$('#signupForm .confirmPassword').val('');
				$('#signupForm .email').val('');
				$('#signupForm .fullname').val('');
				$('#signupForm .birthDate').val('');
				$('#signupForm .avatar').val('');
			},
			complete : function(){
				//document.location.href = '/cat-prj/home';
			}
		});
		}
	}
}

var signinForm = {
	submit : function(){
		var form = $('#signinForm');
		var formData =  new FormData(form[0]);
		if(form.valid()){
			$.ajax({
			url : "/cat-prj/login",
			type : "POST",
			data : formData,
			contentType : false,
			processData : false,
			dataType : "JSON",
			success : function(response) {
				if(response === 'false'){
					$('.error').html('Username and password was wrong !!!');
				}else{
					document.location.href = '/cat-prj/'+response;
				}
			},
			complete : function(){
				//document.location.href = '/cat-prj/'+response;
				//ocument.location.href = '/cat-prj/home';
			}
			});
		}
	}
}