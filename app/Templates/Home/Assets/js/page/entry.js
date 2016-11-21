;$(function(){
	$('#home').tab('show');
	$('#file-error').hide();
	$('#image-error').hide();

	$("#createEntryForm .image").change(function(){
    	previewImage(this);
	});

	$("#createEntryForm .file").change(function(){
    	checkDocument();
	});

	$("#createEntryForm").validate({
		rules : {
			name:{
				required:true,
			},
			description:{
				required:true,
			},
			content : {
				required:true,
			},
			file : {
				required:true,
			},
			image : {
				required:true,
			}
		},
		messages : {
			name:{
				required:'Name is not blank',
			},
			description:{
				required:'Description is not blank',
			},
			content : {
				required:'Content is not blank',
			},
			file : {
				required:'File is not blank',
			},
			image : {
				required:'Image is not blank',
			}
		},
	});
});

var createEntryForm = {
	create : function(){
		var form = $('#createEntryForm');
		var formData =  new FormData(form[0]);
		if(form.valid()){
			$.ajax({
			url : "/ewsd2016/entry/add",
			type : "POST",
			data : formData,
			contentType : false,
			processData : false,
			dataType : "JSON",
			success : function(response) {
				$('#createEntryForm .name').val('');
				$('#createEntryForm .file').val('');
				$('#createEntryForm .image').val('');
				tinyMCE.triggerSave(true,true);
				tinyMCE.activeEditor.setContent('');
			},
		});
		}
	},
	checkDocument : function(){
		var form = $('#createEntryForm');
		var formData =  new FormData(form[0]);
		$.ajax({
			url : "/ewsd2016/file/checkDocument",
			type : "POST",
			data : formData,
			contentType : false,
			processData : false,
			dataType : "JSON",
			success : function(response) {
				if(response === 'wrong-file' ){
					$('#file-error').text("File belongs Document type : doc, docx, txt, pdf .").show().delay(5000).fadeOut();
					$('#createEntryForm .file').val('');
				}
				if(response === 'wrong-size' ){
					$('#file-error').text("Size is larger than default size .").show().delay(5000).fadeOut();
					$('#createEntryForm .file').val('');
				}
				if(response === 'true'){
					$('#file-error').text("File is attached.").show().delay(10000).fadeOut();
				}
			}
		});
	},
	checkImage : function(input){
		var form = $('#createEntryForm');
		var formData =  new FormData(form[0]);
		$.ajax({
			url : "/ewsd2016/file/checkImage",
			type : "POST",
			data : formData,
			contentType : false,
			processData : false,
			dataType : "JSON",
			success : function(response) {
				if(response === 'wrong-file' ){
					$('#image-error').text("File belongs Document type : jpg, jpeg, png, bmp .").show().delay(5000).fadeOut();
					$('#createEntryForm .image').val('');
				}
				if(response === 'wrong-size' ){
					$('#image-error').text("Size is larger than default size .").show().delay(5000).fadeOut();
					$('#createEntryForm .image').val('');
				}
				if(response === 'true'){
					$('#image-error').text("File is attached.").show().delay(10000).fadeOut();
					if (input.files && input.files[0]) {
				        var reader = new FileReader();

				        reader.onload = function (e) {
				            $('.preview').attr('src', e.target.result);
				        }

				        reader.readAsDataURL(input.files[0]);
   					}
				}
			}
		});
	}
};

function previewImage(input){
	createEntryForm.checkImage(input);
}

function checkDocument(){
	createEntryForm.checkDocument();
}