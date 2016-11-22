$(function() {
	var faculty = $('#faculty').val();
	if(faculty === undefined){
		faculty = 'nope';
	}
	displayTable(faculty);

	$('#faculty').change(function(){
		var faculty = $('#faculty').val();
		displayTable(faculty);
	});


	$("#reviewEntryForm").validate({
		rules : {
			comment:{
				required:true
			}
		},
		messages : {
			comment:{
				required:"Comment is not blank"
			}
		},
	});
});

function displayTable(faculty) {
	var dataItems = [];
	var disabled = "";
	if(faculty !== 'nope'){
		disabled = 'disabled';
	}
	$.ajax({
		url : "/ewsd2016/entry/getFaculty",
		type : "GET",
		dataType : "JSON",
		data : {
			faculty : faculty
		},
		success : function(response) {
			var i = 0;
			$.each(response, function(key, value) {
				i++;
				dataItems.push([
						i,
						value.name,value.created_date,value.username,value.facultyName,value.facultyCode,value.status,
						"<button type='button' class='btn btn-sm btn-primary' " + disabled + " onclick='review("
								+ value.id + ");' >Review </button>","<button type='button' class='btn btn-sm btn-primary' onclick='viewComment("
								+ value.id + ");' >View Comments</button>"]);
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
					"sTitle" : "Created Date"
				}, {
					"sTitle" : "Student"
				}, {
					"sTitle" : "Faculty"
				}, {
					"sTitle" : "Faculty Code"
				},{
					"sTitle" : "Status"
				},{
					"sTitle" : "Review"
				},{
					"sTitle" : "Comment"
				}]
			});
		}
	});
}

function review(id){
	$('#reviewEntry').modal('show');
	$('#reviewEntry .file').empty();
	$.ajax({
		url : "/ewsd2016/entry/preReviewCode",
		type : "GET",
		dataType : "JSON",
		data : {
			id : id
		},
		success : function(response) {
			$('#reviewEntry .entryId').text(response.id);
			$('#reviewEntry .entryName').text(response.name);
			$('#reviewEntry .entryDescription').text(response.description);
			$('#reviewEntry .entryContent').text(response.content);
			$('#reviewEntry .facultyCode').text(response.facultyCode);
			$('#reviewEntry .file').append("<a href='"+ response.filePath +"' >" + response.fileName +"</a>");
			$('#reviewEntry .student').text(response.username);
		}
	});
}

function viewComment(id){
	$('#viewComment').modal('show');
	$('#viewComment .modal-body').empty();
	$.ajax({
		url : "/ewsd2016/comment/getByEntry",
		type : "GET",
		dataType : "JSON",
		data : {
			id : id
		},
		success : function(response) {
			$.each(response,function(key,value){
				$('#viewComment .modal-body').append("<div style='border:1px dashed silver;' class='form-group'>"
						+ "<div class='col-sm-2'>"
						+		"<img class='img-responsive' src='"+value.avatar+"' />"
						+ 		"<p>"+value.username+"</p>"
						+ "</div>"
						+ "<div class='col-sm-10'>"
						+ 		"<p style='font-weight:bold;'>"+value.name+"</p>"
						+ 		"<p>"+value.comment+"</p>"
						+       "<p style='font-size:10px'><i>"+value.date_created+"</i></p>"
						+ "</div>"
						+ "</div>"
				);
			});
		}
	});
}

function checkStatus(status){
	var entryId = $("#reviewEntryForm .entryId").html();
	var comment = $("#reviewEntryForm .comment").val();
	if($("#reviewEntryForm").valid()){
		$.ajax({
			url : "/ewsd2016/entry/checkCode",
			type : "POST",
			dataType : "JSON",
			data : {
				status : status,
				id : entryId,
				comment : comment
			},
			success : function(response) {
				$("#reviewEntry").modal("hide");
			}
	});
	}
	var faculty = $('#faculty').val();
	if(faculty === undefined){
		faculty = 'nope';
	}
	displayTable(faculty);
}