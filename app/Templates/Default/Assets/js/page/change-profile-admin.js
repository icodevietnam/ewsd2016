$(function(){
	var form = $("#profileForm");

	$("#profileForm .avatar").change(function(){
    	previewImage(this);
	});

	form.validate({
		rules : {
			fullname:{
				required:true
			},
			email :{
				required: true,
			}
		},
		messages : {
			fullname:{
				required:"fullname is not blank"
			},
			email:{
				required:"Email is not blank"
			},
		},
	});
});

function previewImage(input){
	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function changeProfile(){
	var form = $('#profileForm');
	var formData =  new FormData(form[0]);
	if(form.valid()){
		$.ajax({
			url : "/ewsd2016/user/change-profile",
			type : "POST",
			data : formData,
			contentType : false,
			processData : false,
			dataType : "JSON",
			success : function(response) {
				if(response == true){
					$('.alert-info').text("Change Profile Successfully.").show().delay(5000).fadeOut();
				}else{
					$('.alert-danger').text("Change Profile Fail.").show().delay(5000).fadeOut();
				}
			},
			complete:function(){
			},
			error: function (request, status, error) {
        		alert(request.responseText);
    		}
		});
	}
}