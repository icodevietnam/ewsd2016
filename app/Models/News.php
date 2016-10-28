<?php
namespace App\Models;

use Core\Model;

class News extends Model
{
	
	function __construct()
	{	
		parent::__construct();
	}

	function getAllNews(){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."news WHERE type = 0 order by id desc ");
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function getAllNotifications(){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."news WHERE type = 1 order by id desc ");
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function add($data){
		try {
			$this->db->insert(PREFIX.'news',$data);
			return true;
		} catch (Exception $e) {
			
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}


	function delete($id){
		try {
			$this->db->delete(PREFIX.'news',array('id' => $id));
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

	function get($id){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."news WHERE id =:id",array(':id' => $id));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function update($data,$where){
		try {
			$this->db->update(PREFIX."news",$data,$where);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

}