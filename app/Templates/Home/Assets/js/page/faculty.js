$(function(){
	var code = $('#facultyCode').text();
	var name = $('#facultyName').text();
	var year = $('#listYear').val();
	//Init
	getEntryByCodeAndYear(code,name,year);

	$('#listYear').change(function(){
		var year = $('#listYear').val();
		getEntryByCodeAndYear(code,name,year);
	});
});

function getEntryByCodeAndYear(code,name,year){
	$('#entry').empty();
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
			$.each(response, function(key, value) {
				$('#entry').append("<div style='margin-left : 5 px;' class='col-sm-12 col-md-3'>"
								+ "<p><span style='font-weight:bold;text-align:center;color:#001a66;' >Topic: </span><a style='cursor:pointer;' href='"+ "/ewsd2016/entry?id="+ value.id +"'><span style='font-weight:bold;text-align:center;color:#000000;' >"+ value.name +"</span></a></p>"
				 				+ "<div class='col-sm-12' style='background-image: url("+value.img+");background-size:cover;height:200px;' ></div>"
				 				+ "<p style='margin:5px;'><span>"+value.description+"</span><br/><span>"+value.created_date+"</span></p>"
				 				+ "<a class='btn btn-sm col-md-12 btn-danger' href='/ewsd2016/entry?id="+value.id+"'> Read More </a>"
				 				+"</div>");
			});
		},
		error: function (request, status, error) {
        	console.log(request);
    	}
	});
}

function loadComment(entry){
	
}

