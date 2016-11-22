$(function() {
	displayTable();
});

function displayTable() {
	var dataItems = [];
	$.ajax({
		url : "/ewsd2016/file/getAll",
		type : "GET",
		dataType : "JSON",
		success : function(response) {
			var i = 0;
			$.each(response, function(key, value) {
				i++;
				dataItems.push([
						i,
						value.name,value.size,value.path,value.type,value.ext,value.oldname,value.created_date]);
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
					"sTitle" : "Size"
				}, {
					"sTitle" : "Path"
				}, {
					"sTitle" : "Type"
				}, {
					"sTitle" : "Extension"
				}, {
					"sTitle" : "Old Name"
				}, {
					"sTitle" : "Created Date"
				}]
			});
		}
	});
}


