$(function() {
	displayTable();

	$("#newItemForm .image").change(function(){
    	previewAudio(this);
	});

	$("#updateItemForm .image").change(function(){
    	previewAudio2(this);
	});
	
	$("#newItemForm").validate({
		rules : {
			title:{
				required:true
			},
			description:{
				required:true
			},
			content :{
				required: true
			}
		},
		messages : {
			title:{
				required:"Title is not blank"
			},
			description:{
				required:"Description is not blank"
			},
			content :{
				required :"Content is not blank"
			}
		},
	});
	
	$("#updateItemForm").validate({
		rules : {
			title:{
				required:true
			},
			description:{
				required:true
			},
			content :{
				required: true
			}
		},
		messages : {
			title:{
				required:"Title is not blank"
			},
			description:{
				required:"Description is not blank"
			},
			content :{
				required: "Content is not blank"
			}
		},
	});
});

function displayTable() {
	var dataItems = [];
	$.ajax({
		url : "/cat-prj/news/getAll",
		type : "GET",
		dataType : "JSON",
		success : function(response) {
			var i = 0;
			$.each(response, function(key, value) {
				i++;
				dataItems.push([
						i,
						value.title,"<img alt='image' class='img-rounded' width='60px' src='"
                            + value.image + "' />",value.content,
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
					"sTitle" : "Title"
				}, {
					"sTitle" : "Image"
				}, {
					"sTitle" : "Content"
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
		url : "/cat-prj/news/get",
		type : "GET",
		data : {
			itemId : id
		},
		dataType : "JSON",
		success : function(data) {
			$.each(data, function(key, value) {
				$("#updateItemForm .id").val(value.id);
				$("#updateItemForm .title").val(value.title);
				$("#updateItemForm .description").val(value.description);
				tinyMCE.activeEditor.setContent(value.content);
				$('.preview2').attr('src', value.image);
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
			url : "/cat-prj/news/delete",
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
			url : "/cat-prj/news/update",
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
				$("#updateItemForm .title").val(" ");
				$("#updateItemForm .description").val(" ");
				$("#updateItemForm .content").val(" ");
				$("#updateItem").modal("hide");
			},
			error: function (request, status, error) {
        		alert(request.responseText);
    		}
		});
	}
}

function insertItem() {
	var form = $('#newItemForm');
	var formData =  new FormData(form[0]);
	if(form.valid()){
		$.ajax({
			url : "/cat-prj/news/add",
			type : "POST",
			data : formData,
			contentType : false,
			processData : false,
			dataType : "JSON",
			success : function(response) {
			},
			complete : function(){
				displayTable();
				$("#newItem").modal("hide");
				$("#newItemForm .title").val(" ");
				$("#newItemForm .description").val(" ");
				$("#newItemForm .content").val(" ");
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
