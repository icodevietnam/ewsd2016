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
}

function viewComment(id){
	$('#viewComment').modal('show');
}