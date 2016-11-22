$(function(){

	var registerForm = $('#registerForm');

	$("#registerForm .avatar").change(function(){
    	previewImage(this);
	});

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
							return $('#registerForm .email').val();
						}
					}
				}
			}
		},
		messages : {
			username:{
				required:"Username is not blank",
				remote : "Username is existed. Please input another."
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
				remote : "Email is existed. Please input another."
			}
		},
	});

});

var signupForm = {
	submit : function(){
		var form = $('#registerForm');
		var formData =  new FormData(form[0]);
		if(form.valid()){
			$.ajax({
			url : "/ewsd2016/user/createStudent",
			type : "POST",
			data : formData,
			contentType : false,
			processData : false,
			dataType : "JSON",
			success : function(response) {
				if(response !== null){
					window.location = '/ewsd2016/home';
				}
			},
		});
		}
	}
}


function previewImage(input){
	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}