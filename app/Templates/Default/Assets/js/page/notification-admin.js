$(function() {
	displayTable();
});

function displayTable() {
	var dataItems = [];
	$.ajax({
		url : "/ewsd2016/notification/getAll",
		type : "GET",
		dataType : "JSON",
		success : function(response) {
			var i = 0;
			$.each(response, function(key, value) {
				i++;
				dataItems.push([
						i,
						value.title,value.content,value.created_date,value.status,
						"<button class='btn btn-sm btn-primary' onclick='get("
								+ value.id + ");'>Read</button>" ]);
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
					"sTitle" : "Status"
				}, {
					"sTitle" : "Read"
				} ]
			});
		}
	});
}

function get(id){
$.ajax({
		url : "/ewsd2016/notification/get",
		type : "GET",
		data : {
			itemId : id
		},
		dataType : "JSON",
		success : function(response) {
			$("#notiForm .notiId").html(response.id);
			$("#notiForm .notiTitle").html(response.title);	
			$("#notiForm .notiContent").html(response.content);	
			$("#notiForm .notiFaculty").html(response.fName);	
			$("#notiForm .notiCreatedDate").html(response.created_date);	
		},
		complete : function(){
			$("#viewNotification").modal("show");
		},
		error: function (request, status, error) {
        	alert(request.responseText);
    	}
	});
}

function read(){
	var id = $("#notiForm .notiId").html();
	$.ajax({
			url : "/ewsd2016/notification/read",
			type : "POST",
			data : {
				id : id
			},
			dataType : "JSON",
			success : function(response) {
				displayTable();
				showNoti();
				$("#viewNotification").modal("hide");
			},
			error: function (request, status, error) {
	        	alert(request.responseText);
	    	}
		});
}


