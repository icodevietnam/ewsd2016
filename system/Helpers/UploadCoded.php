<?php

namespace Helpers;

class UploadCoded {
	
	function upload($element,$filter,$size = SIZEIMAGE){
		$message = '';
		$reName = '';
		$valid_file = true;
		$valid_type = false;
		if($_FILES[$element]['name'])
		{
			//if no errors...
			if(!$_FILES[$element]['error'])
			{
				//now is the time to modify the future file name and validate the file
				$name = strtolower($_FILES[$element]['name']); //rename file
				$ext = end((explode(".", $name)));
				$reName = uniqid().'.'.$ext;
				if($_FILES[$element]['size'] > ($size)) 
				{
					$valid_file = false;
					$message = 'Oops!  Your file\'s size is to large.';
				}

				if('image' === $filter){
					if( 'png' === strtolower($ext) ||'jpg' === strtolower($ext) || 'jpeg' === strtolower($ext)  || 'bmp' === strtolower($ext) ){
						$valid_type = true;
					}
				}
				else if('audio' === $filter){
					if( 'mp3' === strtolower($ext) || 'wma' === strtolower($ext)){
						$valid_type = true;
					}
				}else if('audio|image' === $filter || 'image|audio' === $filter){
					if( 'mp3' === strtolower($ext) || 'wma' === strtolower($ext) ||'png' === strtolower($ext) ||'jpg' === strtolower($ext) || 'jpeg' === strtolower($ext)  || 'bmp' === strtolower($ext) ){
						$valid_type = true;
					}
				}else{
					$message = 'Oops!  Your audio file\'s type is wrong.';
					$valid_type = false;
				}
				
				//if the file has passed the test
				if($valid_file && $valid_type)
				{
					//move it to where we want it to be
					move_uploaded_file($_FILES[$element]['tmp_name'], ROOTDIR.'assets/uploads/'.$reName);
					$message = Url::uploadPath().$reName;
				}
			}
			else
			{
				//set that to be the returned message
				$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES[$element]['error'];
			}
		}
		return $message;
	}

	function uploadFile($element,$size = SIZEIMAGE){
		$file = null;
		if($element['name']){
			if(!$element['error']){
				$name = strtolower($element['name']);
				$ext = end((explode(".", $name)));
				$time = time();
				$newName = md5($name.$time).".".$ext;
				move_uploaded_file($element['tmp_name'], ROOTDIR.'assets/entry/'.$newName);
				$file = array('name' => $newName, 'description' => $name, 'size' => $element['size'], 'path' => Url::entryPath().$newName,'type' => 'entry', 'ext' => $ext,  'oldname' => $name );
			}
		}
		return $file;
	}


	function checkImage($element,$size = SIZEIMAGE){
		$message = null;
		if($element['name']){
			//if no errors...
			if(!$element['error']){
				$name = strtolower($element['name']);
				$ext = end((explode(".", $name)));
				$time = time();
				$newName = md5($name.$time).$ext;

				if( (strtolower($ext) === 'png' || strtolower($ext) === 'jpg' || strtolower($ext) === 'jpeg' || strtolower($ext) ==='bmp') && ( $element['size'] < ($size) ) ){
					$message = 'true';
				}
				else{
					if($element['size'] > ($size)){
						$message = 'wrong-size';
					}else{
						$message = 'wrong-file';
					}
				}
			}
		}
		return $message;
	}

	function checkDocument($element,$size = SIZEIMAGE){
		$message = null;
		if($element['name']){
			//if no errors...
			if(!$element['error']){
				$name = strtolower($element['name']);
				$ext = end((explode(".", $name)));
				$time = time();
				$newName = md5($name.$time).$ext;

				if( (strtolower($ext) === 'doc' || strtolower($ext) === 'docx' || strtolower($ext) === 'txt' || strtolower($ext) ==='pdf') && ( $element['size'] < ($size) ) ){
					$message = 'true';
				}
				else{
					if($element['size'] > ($size)){
						$message = 'wrong-size';
					}else{
						$message = 'wrong-file';
					}
				}
			}
		}
		return $message;
	}

}