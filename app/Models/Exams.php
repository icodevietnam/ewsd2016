<?php
namespace app\Models;

use Core\Model;

class Exams extends Model
{
	
	function __construct()
	{	
		parent::__construct();
	}

	// O is false, 1 is true means completed
	public function checkExams($userId){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."examinations WHERE user =:userId AND complete = 0",array(':userId' => $userId));
			if(count($data) >= 1){
				return true;
			}else{
				return false;
			}
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return true;
		}
	}

	public function getExamsById($userId){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."examinations WHERE user =:userId ORDER BY date_start desc ",array(':userId' => $userId));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	public function getExamsByCode($code){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."examinations WHERE name =:code ",array(':code' => $code));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function add($data){
		try {
			$this->db->insert(PREFIX.'examinations',$data);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

	function update($data,$where){
		try {
			$this->db->update(PREFIX."examinations",$data,$where);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

}