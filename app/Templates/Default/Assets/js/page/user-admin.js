$(function() {
	displayTable();
	$(".dateInput").datepicker();

	$("#newItemForm .avatar").change(function(){
    	previewImage(this);
	});

	$("#updateItemForm .avatar").change(function(){
    	previewImage2(this);
	});

	$("#newItemForm").validate({
		rules : {
			username:{
				required:true,
				remote : {
					url : '/cat-prj/user/checkUser',
					type : 'GET',
					data : {
						username : function(){
							return $('#newItemForm .username').val();
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
					url : '/cat-prj/user/checkEmail',
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
	
	$("#updateItemForm").validate({
		rules : {
			username:{
				required:true
			},
			password:{
				required:true,
				minlength : 5
			},
			fullName:{
				required:true
			},
			birthDate:{
				required : true
			},
			email :{
				required : true
			}
		},
		messages : {
			username:{
				required:"Username is not blank"
			},
			password:{
				required:"Password is not blank",
				minlength : "Password is not less than 5 characters."
			},
			fullName:{
				required:"Full Name is not blank"
			},
			birthDate:{
				required : "Birth date is not blank"
			},
			email :{
				required : "Email is not blank",
			}
		},
	});
});

function getRole(id) {
	var roleName = '';
	if(id == null){
		roleName = 'customer'
	}
	else{
		$.ajax({
			url : "/cat-prj/role/get",
			type : "GET",
			data : {
				itemId : id
			},
			async : false,
			dataType : "JSON",
			success : function(data) {
				$.each(data, function(key, value) {
					roleName = value.name;
				})	
			},
			complete : function(){
			},
			error: function (request, status, error) {
	        	alert(request.responseText);
	    	}
		});
	}
	return roleName;
}

function displayTable() {
	var dataItems = [];
	$.ajax({
		url : "/cat-prj/user/getAll",
		type : "GET",
		dataType : "JSON",
		success : function(response) {
			var i = 0;
			$.each(response, function(key, value) {
				i++;
				dataItems.push([
						i,
						value.username,value.fullname,value.email,getRole(value.role),
						"<img alt='image' class='img-rounded' width='60px' src='"
                            + value.avatar + "' />",
						"<button class='btn btn-sm btn-primary' onclick='getItem("
								+ value.id + ");' >Edit</button>",
						"<button class='btn btn-sm btn-danger' onclick='deleteItem("
								+ value.id + ");'>Delete</button>" ]);
			});
			$('#tblItems').dataTable({
				"bDestroy" : true,
				"bSort" : true,
				"bFilter" : true,
				"bLengthChange" : true,
				"bPaginate" : true,
				"sDom" : '<"top">rt<"bottom"flp><"clear">',
				"aaData" : dataItems,
				"aaSorting" : [],
				"aoColumns" : [ {
					"sTitle" : "No"
				}, {
					"sTitle" : "Username"
				}, {
					"sTitle" : "Full Name"
				}, {
					"sTitle" : "Email"
				}, {
					"sTitle" : "Role"
				}, {
					"sTitle" : "Avatar"
				}, {
					"sTitle" : "Edit"
				}, {
					"sTitle" : "Delete"
				} ]
			});
		}
	});
}

function getItem(id) {
	$.ajax({
		url : "/cat-prj/user/get",
		type : "GET",
		data : {
			itemId : id
		},
		dataType : "JSON",
		success : function(data) {
			$.each(data, function(key, value) {
				$("#updateItemForm .id").val(value.id);
				$("#updateItemForm .username").val(value.username);
				$("#updateItemForm .password").val(value.password);
				$("#updateItemForm .confirmPassword").val(value.password);
				$("#updateItemForm .fullName").val(value.fullname);
				var date = moment(value.birthdate).format('MM/DD/YYYY');
				$("#updateItemForm .birthDate").val(date);
				$("#updateItemForm .birthDate").attr('data-date',date);
				$("#updateItemForm .email").val(value.email);
				$('#updateItemForm .role').selectpicker('val',value.role);
				$('.preview2').attr('src', value.avatar);
				if(value.role == null){
					$('#roleCombobox').hide();
				}else{
					$('#roleCombobox').show();
				}
			})	
		},
		complete : function(){
			$("#updateItem").modal("show");
		},
		error: function (request, status, error) {
        	alert(request.responseText);
    	}
	});
}

function deleteItem(id) {
	if (confirm("Are you sure you want to proceed?") == true) {
		$.ajax({
			url : "/cat-prj/user/delete",
			type : "POST",
			data : {
				itemId : id
			},
			dataType : "JSON",
			success : function(response) {
			},
			complete : function(){
				displayTable();
			}
		});
	}
}

function update() {
	var form = $('#updateItemForm');
	var formData =  new FormData(form[0]);
	if(form.valid()){
		$.ajax({
			url : "/cat-prj/user/update",
			type : "POST",
			data : formData,
			contentType : false,
			processData : false,
			dataType : "JSON",
			success : function(response) {
			},
			complete:function(){
				displayTable();
				$("#updateItemForm .id").val(" ");
				$("#updateItemForm .username").val(" ");
				$("#updateItemForm .password").val(" ");
				$("#updateItemForm .confirmPassword").val(" ");
				$("#updateItemForm .fullName").val(" ");
				$("#updateItemForm .birthDate").val(" ");
				$("#updateItemForm .email").val(" ");
				$("#updateItem").modal("hide");
			}
		});
	}
}

function insertItem() {
	var form = $('#newItemForm');
	var formData =  new FormData(form[0]);
	if(form.valid()){
		$.ajax({
			url : "/cat-prj/user/add",
			type : "POST",
			data : formData,
			contentType : false,
			processData : false,
			dataType : "JSON",
			success : function(response) {
			},
			complete : function(){
				displayTable();
				$("#newItemForm .username").val(" ");
				$("#newItemForm .password").val(" ");
				$("#newItemForm .confirmPassword").val(" ");
				$("#newItemForm .fullName").val(" ");
				$("#newItemForm .birthDate").val(" ");
				$("#newItemForm .email").val(" ");
				$("#newItem").modal("hide");
			}
		});
	}
}

function previewImage(input){
	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.preview1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function previewImage2(input){
	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.preview2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
