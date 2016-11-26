$(function() {
	displayTable2();
	displayTable();
});

function displayTable2() {
	var dataItems = [];
	$.ajax({
		url : "/ewsd2016/faculty/getContributorsByEachAcademicYear",
		type : "GET",
		dataType : "JSON",
		success : function(response) {
			var i = 0;
			$.each(response, function(key, value) {
			i++;
			dataItems.push([i,value.name,value.description,value.year,value.countContributor]);
			});
			$('#tblContributor').dataTable({
				"bDestroy" : true,
				"bSort" : true,
				"bFilter" : true,
				"bLengthChange" : true,
				"bPaginate" : true,
				"sDom" : '<"top">rt<"bottom"flp><"clear">',
				"aaData" : dataItems,
				"aaSorting" : [],
				"aoColumns" : [{
					"sTitle" : "No"
				}, {
					"sTitle" : "Name"
				}, {
					"sTitle" : "Description"
				}, {
					"sTitle" : "Year"
				}, {
					"sTitle" : "Count Contributors"
				}]
			});
		}
	});
}

function displayTable() {
	var dataItems = [];
	var dataPoints = [];
	$.ajax({
		url : "/ewsd2016/faculty/getEntriesByEachAcademicYear",
		type : "GET",
		dataType : "JSON",
		success : function(response) {
			var i = 0;
			$.each(response, function(key, value) {
				i++;
				var percent = (value.countEntries / value.total ) * 100;
				dataItems.push([i,value.name,value.description,value.year,value.countEntries]);
				dataPoints.push({y:percent,legendText : value.name, label: value.name});

			});
			//Show Chart
			var chart = new CanvasJS.Chart("chartContainer",
			{
				title:{
					text: "Percentage of Entries of each faculty"
				},
		                animationEnabled: true,
				legend:{
					verticalAlign: "center",
					horizontalAlign: "left",
					fontSize: 20,
					fontFamily: "Helvetica"        
				},
				theme: "theme2",
				data: [
				{        
					type: "pie",       
					indexLabelFontFamily: "Garamond",       
					indexLabelFontSize: 20,
					indexLabel: "{label} : {y} %",
					startAngle:-20,
					endAngle : -20,
					showInLegend: true,
					toolTipContent:"{legendText} : {y} %",
					dataPoints: dataPoints
				}
				]
			});
			chart.render();
			$('#tblFaculty').dataTable({
				"bDestroy" : true,
				"bSort" : true,
				"bFilter" : true,
				"bLengthChange" : true,
				"bPaginate" : true,
				"sDom" : '<"top">rt<"bottom"flp><"clear">',
				"aaData" : dataItems,
				"aaSorting" : [],
				"aoColumns" : [{
					"sTitle" : "No"
				}, {
					"sTitle" : "Name"
				}, {
					"sTitle" : "Description"
				}, {
					"sTitle" : "Year"
				}, {
					"sTitle" : "Count Entries"
				}]
			});
		}
	});
}
