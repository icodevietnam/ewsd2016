<?php
namespace App\Models;

use Core\Model;

class Faculties extends Model
{

	function __construct()
	{	
		parent::__construct();
	}

	function getAll(){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."faculty order by id desc ");
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function add($data){
		try {
			$this->db->insert(PREFIX.'faculty',$data);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}


	function delete($id){
		try {
			$this->db->delete(PREFIX.'faculty',array('id' => $id));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	function get($id){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."faculty WHERE id =:id",array(':id' => $id));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function getFacultiesByYear($year){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."faculty WHERE year =:year ORDER BY description ",array(':year' => $year));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function getFacultyByCode($code){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."faculty WHERE code =:code ",array(':code' => $code));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data[0];
	}

	function getFacultiesByCoordinator($mktCoor){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."faculty WHERE mkt_coor =:mktCoor",array(':mktCoor' => $mktCoor));
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

	function getFaculty($mktCoor){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."faculty WHERE mkt_coor =:mktCoor",array(':mktCoor' => $mktCoor));
			
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data[0];
	}

	function update($data,$where){
		try {
			$this->db->update(PREFIX."faculty",$data,$where);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

	//Number of contributions within each Faculty for each academic year.
	function getEntriesByEachAcademicYear(){
		$data = null;
		try {
			$data = $this->db->select("SELECT F.id , F.name, F.description, F.year ,( SELECT count(1) FROM ".PREFIX."entry E where E.faculty = F.id  ) as 'countEntries', ( SELECT count(1) FROM entry E ) as 'total'  FROM ".PREFIX."faculty F ");
			
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function getContributorsByEachAcademicYear(){
		$data = null;
		try {
			$data = $this->db->select("SELECT F.id , F.name, F.description, F.year , ( SELECT COUNT(-1) FROM ".PREFIX."user U Where U.id IN (SELECT student from ".PREFIX."entry where faculty = F.id )) AS 'countContributor'  FROM ".PREFIX."faculty F ");
			
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

}