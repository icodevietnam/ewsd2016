$(function(){
	displayTable('approved');

	$("#listStatus").change(function(){
		var statusValue = $("#listStatus").val();
		displayTable(statusValue);
	});
});


function displayTable(status) {
	var dataItems = [];
	$.ajax({
		url : "/ewsd2016/entry/getEntryByStatus",
		type : "GET",
		dataType : "JSON",
		data : {
			status : status
		},
		success : function(response) {
			var i = 0;
			$.each(response, function(key, value) {
				i++;
				dataItems.push([
						i,
						value.name,value.description,value.content, value.created_date,
						"<a class='btn btn-sm btn-info' href='/ewsd2016/entry?id="+value.id+"'>View Entry</a>"]);
			});
			$('#tblEntry').dataTable({
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
					"sTitle" : "Content"
				}, {
					"sTitle" : "Created Date"
				}, {
					"sTitle" : "View"
				}]
			});
		}
	});
}