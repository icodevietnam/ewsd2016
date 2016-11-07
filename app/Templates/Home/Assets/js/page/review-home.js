;$(function(){
	var questionsStr = $('#questionStr').html();
	var backupStr = $('#backup').html();
	console.log(questionsStr);
	var quesArr = questionsStr.split('-');
	var count =0;
	for(var i=0;i<quesArr.length;i++){
		console.log(checkRightAnswer(quesArr[i])+'-'+quesArr[i]);
		++count;
		if(checkRightAnswer(quesArr[i])===true){
			loadAnswer(quesArr[i],'checkbox',count);
		}else{
			loadAnswer(quesArr[i],'radio',count);
		}
	}

	function checkRightAnswer(questionId){
		var isCheckBox = '';
		$.ajax({
			url : "/cat-prj/answer/checkAnswer",
			type : "GET",
			dataType : "JSON",
			async : false,
			data : {
				questionId : questionId
			},
			success : function(response) {
				isCheckBox = response;
			},
			complete : function(){
			},
			error: function (request, status, error) {
	        	console.log(error);
	    	}
		});
		return isCheckBox;
	}

	function loadAnswer(questionId,type,length){
		isCheckBox = true;
		$.ajax({
			url : "/cat-prj/answer/getAnswer",
			type : "GET",
			data : {
				questionId : questionId
			},
			async : false,
			dataType : "JSON",
			success : function(response) {
				var count = 0;
				$.each(response, function(key, value) {
					count++;
					console.log(value.correct);
					if(type==='radio'){
						var html = "<p>" +
      					"<input "+ getCheck(value.id) +" id='answer-"+value.id+"' name='answer-"+(length)+"' disabled value='"+value.id+"' type='radio' />" +
      					"<label "+correctStyle(value.correct)+" for='answer-"+value.id+"' >"+value.name+"</label>" + correctValue(value.correct) +
    					"</p>";
						
					}else{
						var html = "<p>" +
      					"<input "+ getCheck(value.id) +" id='answer-"+value.id+"' name='answer-"+(length)+"[]' disabled value='"+value.id+"' type='checkbox' />" +
      					"<label "+correctStyle(value.correct)+" class='for='answer-"+value.id+"' >"+value.name+"</label>" + correctValue(value.correct) +
    					"</p>";
					}
					$('#question-'+length).append(html);
				});
			},
			complete : function(){
				//document.location.href = '/cat-prj/home';
			},
			error: function (request, status, error) {
	        	console.log(error);
	    	}
		});
	}

	function correctValue(value){
		if(value === '1'){
			return "<i class='small material-icons'>done</i>";
		}else{
			return '';
		}
	}

	function correctStyle(value){
		if(value === '1'){
			return "style='color:blue;margin-right : 10px;'";
		}else{
			return '';
		}
	}

	function getCheck(value){
		if(backupStr.indexOf(value+'') != -1){
			return 'checked';
		}else{
			return '';
		}
	}
});
