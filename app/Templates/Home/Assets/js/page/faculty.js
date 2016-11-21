$(function(){
	var code = $('#facultyCode').text();
	var name = $('#facultyName').text();
	var year = $('#listYear').val();

	getEntryByCodeAndYear(code,name,year);

});

function getEntryByCodeAndYear(code,name,year){
	alert(code+"-"+name+"-"+year);
	$.ajax({
		url : "/ewsd2016/entry/getFacultyPage",
		type : "GET",
		dataType : "JSON",
		data : {
			code : code,
			name : name,
			year : year
		},
		success : function(response) {
			console.log(response);
			var i = 0;
			$.each(response, function(key, value) {
				//alert(value.name);		
			});
		},
		error: function (request, status, error) {
        	console.log(request);
    	}
	});
}

