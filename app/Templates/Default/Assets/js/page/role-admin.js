$(function() {
	displayTable();
	
	$("#newItemForm").validate({
		rules : {
			name:{
				required:true
			},
			description:{
				required:true
			}
		},
		messages : {
			name:{
				required:"Name is not blank"
			},
			description:{
				required:"Description is not blank"
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
			}
		},
		messages : {
			name:{
				required:"Name is not blank"
			},
			description:{
				required:"Description is not blank"
			}
		},
	});
});

function displayTable() {
	var dataItems = [];
	$.ajax({
		url : "/cat-prj/role/getAll",
		type : "GET",
		dataType : "JSON",
		success : function(response) {
			var i = 0;
			$.each(response, function(key, value) {
				i++;
				dataItems.push([
						i,
						value.name,value.description,
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
					"sTitle" : "Name"
				}, {
					"sTitle" : "Description"
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
		url : "/cat-prj/role/get",
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
			url : "/cat-prj/role/delete",
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
	if($("#updateItemForm").valid()){
		var id = $("#updateItemForm .id").val();
		var name = $("#updateItemForm .name").val();
		var description = $("#updateItemForm .description").val();
		$.ajax({
			url : "/cat-prj/role/update",
			type : "POST",
			data : {
				id : id,
				name : name,
				description : description
			},
			dataType : "JSON",
			success : function(response) {
			},
			complete:function(){
				displayTable();
				$("#updateItemForm .id").val(" ");
				$("#updateItemForm .name").val(" ");
				$("#updateItemForm .description").val(" ");
				$("#updateItem").modal("hide");
			}
		});
	}
}

function insertItem() {
	if($("#newItemForm").valid()){
		var name = $("#newItemForm .name").val();
		var description = $("#newItemForm .description").val();
		$.ajax({
			url : "/cat-prj/role/add",
			type : "POST",
			data : {
				name : name,
				description : description
			},
			dataType : "JSON",
			success : function(response) {
			},
			complete : function(){
				displayTable();
				$("#newItem").modal("hide");
				$("#newItemForm .name").val(" ");
				$("#newItemForm .description").val(" ");
			}
		});
	}
}
