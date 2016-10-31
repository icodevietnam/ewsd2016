<?php
namespace app\Models;

use Core\Model;

class Users extends Model
{
	
	function __construct()
	{	
		parent::__construct();
	}

	//Get All

	public function getAll(){
		return $this->db->select("SELECT * FROM ".PREFIX."user order by id desc ");
	}

	function add($data){
		try {
			$this->db->insert(PREFIX.'user',$data);
			return true;
		} catch (Exception $e) {
			
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}


	function delete($id){
		try {
			$this->db->delete(PREFIX.'user',array('id' => $id));
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

	function checkEmail($email){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."user WHERE email =:email",array(':email' => $email));
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

	function checkUsername($username){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."user WHERE username =:username",array(':username' => $username));
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

	function checkPassword($password,$id){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."user WHERE password =:password AND id = :id",array(':password' => $password,':id' => $id));
			if(count($data) >= 1){
				return true;
			}else{
				return false;
			}
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

	function get($id){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."user WHERE id =:id",array(':id' => $id));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function update($data,$where){
		try {
			$this->db->update(PREFIX."user",$data,$where);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

	function loginConsole($username,$password){
		$data = null;
		try {
			$data = $this->db->select("SELECT U.*, R.name as 'roleName' FROM ".PREFIX."user U, ".PREFIX."role R  WHERE U.username = :username AND U.password = :password AND U.role = R.id AND (R.code='admin' OR R.code = 'mkmng' OR R.code = 'mkcood') ",array(':username' => $username,':password' => $password));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function login($username,$password){
		$data = null;
		try {
			$data = $this->db->select("SELECT U.* FROM ".PREFIX."user U WHERE ( U.username = :username OR U.email = :username ) AND U.password = :password AND U.role IS NULL",array(':username' => $username,':password' => $password));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

}