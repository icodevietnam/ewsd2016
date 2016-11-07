;$(function(){

});

var testForm = {
	submit : function(){
		var form = $('#aboutUsForm');
		if(form.valid()){
			$('.success').html('Sent Email Successfully');
		}
	}
}