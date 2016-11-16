<?php
namespace app\Models;

use Core\Model;

class Answers extends Model
{

	function __construct()
	{	
		parent::__construct();
	}

	function getAll(){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."answers order by id desc ");
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function add($data){
		try {
			$this->db->insert(PREFIX.'answers',$data);
			return true;
		} catch (Exception $e) {
			
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}


	function delete($id){
		try {
			$this->db->delete(PREFIX.'answers',array('id' => $id));
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

	function getAnswers($quesId){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."answers WHERE question = :quesId",array(':quesId' => $quesId));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function get($id){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."answers WHERE id =:id",array(':id' => $id));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function getAnswer($questionId){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."answers WHERE question =:questionId",array(':questionId' => $questionId));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function checkAnswer($questionId){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."answers WHERE question =:questionId AND correct= 1 ",array(':questionId' => $questionId));
			if(count($data)>1){
				return true;
			}else{
				return false;
			}
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

	function update($data,$where){
		try {
			$this->db->update(PREFIX."answers",$data,$where);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}
}