$(function() {
	displayTable();

	$("#newItemForm .year").on("change",function(){
		var name = $("#newItemForm .name").val();
		var year = $("#newItemForm .year").val();
		$("#newItemForm .code").val(name+"-"+year);
	});

	$("#newItemForm .name").on("change",function(){
		var name = $("#newItemForm .name").val();
		var year = $("#newItemForm .year").val();
		$("#newItemForm .code").val(name+"-"+year);
	});


	$("#updateItemForm .year").on("change",function(){
		var name = $("#updateItemForm .name").val();
		var year = $("#updateItemForm .year").val();
		$("#updateItemForm .code").val(name+"-"+year);
	});

	$("#updateItemForm .name").on("change",function(){
		var name = $("#updateItemForm .name").val();
		var year = $("#updateItemForm .year").val();
		$("#updateItemForm .code").val(name+"-"+year);
	});

	
	
	$("#newItemForm").validate({
		rules : {
			name:{
				required:true
			},
			description:{
				required:true
			},
			code :{
				required: true
			}
		},
		messages : {
			name:{
				required:"Title is not blank"
			},
			description:{
				required:"Description is not blank"
			},
			code :{
				required :"Content is not blank"
			}
		},
	});
	
	$("#updateItemForm").validate({
		rules : {
			name:{
				required:true
			},
			description:{
				required:true
			},
			code :{
				required: true
			}
		},
		messages : {
			name:{
				required:"Title is not blank"
			},
			description:{
				required:"Description is not blank"
			},
			code :{
				required: "Content is not blank"
			}
		},
	});
});

function displayTable() {
	var dataItems = [];
	$.ajax({
		url : "/ewsd2016/faculty/getAll",
		type : "GET",
		dataType : "JSON",
		success : function(response) {
			var i = 0;
			$.each(response, function(key, value) {
				i++;
				dataItems.push([
						i,
						value.name,value.description,value.code,value.year,getUser(value.mkt_coor),
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
					"sTitle" : "Name - Short"
				}, {
					"sTitle" : "Description"
				}, {
					"sTitle" : "Code"
				}, {
					"sTitle" : "Year"
				}, {
					"sTitle" : "Marketing Coordinator"
				}, {
					"sTitle" : "Edit"
				}, {
					"sTitle" : "Delete"
				} ]
			});
		}
	});
	reloadMkcoor();
}

function getItem(id) {
	$.ajax({
		url : "/ewsd2016/faculty/get",
		type : "GET",
		data : {
			itemId : id
		},
		dataType : "JSON",
		success : function(data) {
			$.each(data, function(key, value) {
				$("#updateItemForm .id").val(value.id);
				$("#updateItemForm .name").val(value.name);
				$("#updateItemForm .description").val(value.description);
				$("#updateItemForm .code").val(value.code);
				$('#updateItemForm .year').selectpicker('val',value.year);
				$('#updateItemForm .mkt_coor').selectpicker('val',value.mkt_coor);
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
			url : "/ewsd2016/faculty/delete",
			type : "POST",
			data : {
				itemId : id
			},
			dataType : "JSON",
			success : function(response) {
				if(response === false){
					alert("Can't not delete because we have relation-ship from table ");
					displayTable();
				}
			},
			complete : function(){
				
			}
		});
	}
}

function update() {
	var form = $('#updateItemForm');
	var formData =  new FormData(form[0]);
	if(form.valid()){
		$.ajax({
			url : "/ewsd2016/faculty/update",
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
			url : "/ewsd2016/faculty/add",
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
				$("#newItemForm .name").val(" ");
				$("#newItemForm .description").val(" ");
				$("#newItemForm .code").val(" ");
			}
		});
	}
}

function getUser(id) {
	var name = '';
	$.ajax({
			url : "/ewsd2016/user/get",
			type : "GET",
			data : {
				itemId : id
			},
			async : false,
			dataType : "JSON",
			success : function(data) {
				if(id == null){
					name = "<p style='color:blue;'>No Assign</p>";
				}else{
					$.each(data, function(key, value) {
						name = "<p style='color:orange;font-weight:bold;'>" + value.username +"</p>";
					});
				}	
			},
			complete : function(){
			},
			error: function (request, status, error) {
	        	alert(request.responseText);
	    	}
	});
	return name;
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


function reloadMkcoor(){
	$.ajax({
			url : "/ewsd2016/user/reloadMkcoor",
			type : "GET",
			dataType : "JSON",
			success : function(response) {
				$('select.mkcoor').find('option').remove();
				$.each(response,function(key,value){
					$('select.mkcoor').append("<option value='"+ value.id +"' >" + value.name + "</option>");
				})
			},
			complete : function(){
			},
			error: function (request, status, error) {
	        	alert(request.responseText);
	    	}
	});
}
