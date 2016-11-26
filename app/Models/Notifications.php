<?php
namespace App\Models;

use Core\Model;

class Notifications extends Model
{

	function __construct()
	{	
		parent::__construct();
	}

	function getAll(){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."notification order by created_date desc ");
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function getByFaculty($faculty){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."notification  WHERE faculty =:faculty order by created_date desc ",array(':faculty' => $faculty));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function add($data){
		try {
			$this->db->insert(PREFIX.'notification',$data);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}


	function delete($id){
		try {
			$this->db->delete(PREFIX.'notification',array('id' => $id));
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

	function get($id){
		$data = null;
		try {
			$data = $this->db->select("SELECT N.*, concat(F.name,'-',F.year) as 'fName' FROM ".PREFIX." notification N, faculty F WHERE N.id =:id AND N.faculty = F.id ",array(':id' => $id));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data[0];
	}

	function getNotificationByFaculty($faculty){
		$data = null;
		try {
			$data = $this->db->select("SELECT count(-1) as 'count' FROM ".PREFIX."notification WHERE faculty =:faculty AND status = 'none' ",array(':faculty' => $faculty));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data[0];
	}

	function update($data,$where){
		try {
			$this->db->update(PREFIX."notification",$data,$where);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

}