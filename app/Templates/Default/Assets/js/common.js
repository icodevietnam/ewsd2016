$(function(){
	showNoti();
});

function showNoti(){
	$.ajax({
		url : "/ewsd2016/notification/countInbox",
		type : "GET",
		dataType : "JSON",
		success : function(response) {
			$('#notiBadge').html(response);
		}
	});
}