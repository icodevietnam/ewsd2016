;$(function(){
	var form = $("#passwordForm");

	form.validate({
		rules:{
			oldPassword : {
				required : true,
				remote : {
					url : '/ewsd2016/user/checkPassword',
					type : 'GET',
					data : {
						oldPassword : function(){
							return $('#passwordForm .oldPassword').val();
						},
						id : function(){
							return $('#passwordForm .id').val();
						}
					}
				}
			},
			newPassword : {
				required : true
			},
			confirmPassword : {
				required : true,
				equalTo : '.newPassword'
			}
		},
		messages:{
			oldPassword : {
				required : "Old Password is not blank",
				remote : "This password is not like the old password"
			},
			newPassword : {
				required : "New Password is not blank"
			},
			confirmPassword : {
				required : "Confirm Password is not blank",
				equalTo : 'New Password and Confirm password are not the same'
			}
		}
	});

});

var changePasswordForm = {
	changePassword : function(){
		var form = $('#passwordForm');
		var formData =  new FormData(form[0]);
		if(form.valid()){
			$.ajax({
				url : "/ewsd2016/user/changeMyPassword",
				type : "POST",
				data : formData,
				contentType : false,
				processData : false,
				dataType : "JSON",
				success : function(response) {
					if(response == true){
						$('.alert-info').text("Change Password Successfully.").show().delay(5000).fadeOut();
					}else{
						$('.alert-danger').text("Change Password Fail.").show().delay(5000).fadeOut();
					}
				},
				complete:function(){
					
				}
			});
		}
	}
}