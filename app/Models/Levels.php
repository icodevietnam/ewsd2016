<?php
namespace app\Models;

use Core\Model;

class Levels extends Model
{
	
	function __construct()
	{	
		parent::__construct();
	}

	//Get All

	public function getAll(){
		return $this->db->select("SELECT * FROM ".PREFIX."levels order by id desc ");
	}

	function add($data){
		try {
			$this->db->insert(PREFIX.'levels',$data);
			return true;
		} catch (Exception $e) {
			
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}


	function delete($id){
		try {
			$this->db->delete(PREFIX.'levels',array('id' => $id));
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

	function get($id){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."levels WHERE id =:id",array(':id' => $id));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function update($data,$where){
		try {
			$this->db->update(PREFIX."levels",$data,$where);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

}