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

	function getUsername($username){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."user WHERE username =:username",array(':username' => $username));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function getUserByCode($code){
		$data = null;
		try {
			$data = $this->db->select("SELECT U.*, R.id as roleId, R.name as roleName FROM ".PREFIX."user U, ".PREFIX." role R  WHERE R.code =:code AND U.role = R.id ",array(':code' => $code));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function getCoordinatorWithoutManage($code,$count){
		$data = null;
		try {
			$query = " SELECT U.*, R.id as roleId, R.name as roleName FROM ".PREFIX."user U, ".PREFIX." role R  WHERE R.code =:code AND U.role = R.id ";
			if($count > 0){
				$query.= " AND U.id NOT IN ( SELECT mkt_coor FROM faculty )";
			}
			$data = $this->db->select($query,array(':code' => $code));
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
			$data = $this->db->select("SELECT U.*, R.name as 'roleName', R.code as 'roleCode' FROM ".PREFIX."user U, ".PREFIX."role R  WHERE U.username = :username AND U.password = :password AND U.role = R.id AND (R.code='admin' OR R.code = 'mkmng' OR R.code = 'mkcoor') ",array(':username' => $username,':password' => $password));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function login($username,$password){
		$data = null;
		try {
			$data = $this->db->select("SELECT U.* FROM ".PREFIX."user U WHERE ( U.username = :username OR U.email = :username ) AND U.password = :password AND U.role IN (SELECT id FROM role Where code = 'student' ) ",array(':username' => $username,':password' => $password));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

}