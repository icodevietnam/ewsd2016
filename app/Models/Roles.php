<?php
namespace App\Models;

use Core\Model;

class Roles extends Model
{
	
	function __construct()
	{	
		parent::__construct();
	}

	function getAll(){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."role order by id desc ");
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function add($data){
		try {
			$this->db->insert(PREFIX.'role',$data);
			return true;
		} catch (Exception $e) {
			
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

	function checkCode($code){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."role WHERE code =:code",array(':code' => $code));
			if(count($data) >= 1){
				return false;
			}else{
				return true;
			}
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return true;
		}
	}

	function getFitRoles($code){
		$data = null;
		$query = '';
		try {
			if($code == 'admin'){
				$query = ("SELECT * FROM ".PREFIX."role order by id desc ");
			}else if($code == 'mkmng'){
				$query = ("SELECT * FROM ".PREFIX."role WHERE code = 'mkcoor' OR code= 'student' order by id desc ");
			}else {
				$query = ("SELECT * FROM ".PREFIX."role WHERE code= 'student' order by id desc ");
			}
			$data = $this->db->select($query);
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}


	function delete($id){
		try {
			$this->db->delete(PREFIX.'role',array('id' => $id));
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

	function get($id){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."role WHERE id =:id",array(':id' => $id));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function getCode($code){
		$data = null;
		try{
			$data = $this->db->select("SELECT * FROM ".PREFIX."role WHERE code =:code",array(':code' => $code));
		}catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function update($data,$where){
		try {
			$this->db->update(PREFIX."role",$data,$where);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

}