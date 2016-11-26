$(function(){
	displayTableEntriesWithoutComment();
	getEntriesWithOutComment14days();
});

function displayTableEntriesWithoutComment() {
	var dataItems = [];
	var disabled = "";
	$.ajax({
		url : "/ewsd2016/entry/getEntriesWithOutComment",
		type : "GET",
		dataType : "JSON",
		success : function(response) {
			var i = 0;
			$.each(response, function(key, value) {
				i++;
				dataItems.push([
						i,
						value.name,value.created_date,value.username,value.facultyName,value.facultyCode,value.status]);
			});
			$('#tblEntryReport1').dataTable({
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
				}]
			});
		}
	});
}

function getEntriesWithOutComment14days() {
	var dataItems = [];
	var disabled = "";
	$.ajax({
		url : "/ewsd2016/entry/getEntriesWithOutComment14days",
		type : "GET",
		dataType : "JSON",
		success : function(response) {
			var i = 0;
			$.each(response, function(key, value) {
				i++;
				dataItems.push([
						i,
						value.name,value.created_date,value.username,value.facultyName,value.facultyCode,value.status]);
			});
			$('#tblEntryReport2').dataTable({
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
				}]
			});
		}
	});
}