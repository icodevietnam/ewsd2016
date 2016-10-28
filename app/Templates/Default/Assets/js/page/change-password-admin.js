;$(function(){
	var form = $("#passwordForm");

	form.validate({
		rules:{
			oldPassword : {
				required : true,
				remote : {
					url : '/cat-prj/user/checkPassword',
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
				url : "/cat-prj/user/changeMyPassword",
				type : "POST",
				data : formData,
				contentType : false,
				processData : false,
				dataType : "JSON",
				success : function(response) {
				},
				complete:function(){
					$('.alert-danger').text("Change Your Password Successfully").show().delay(5000).fadeOut();
					/*displayTable();
					$("#updateItemForm .id").val(" ");
					$("#updateItemForm .username").val(" ");
					$("#updateItemForm .password").val(" ");
					$("#updateItemForm .confirmPassword").val(" ");
					$("#updateItemForm .fullName").val(" ");
					$("#updateItemForm .birthDate").val(" ");
					$("#updateItemForm .email").val(" ");
					$("#updateItem").modal("hide");*/
				}
			});
		}
	}
}