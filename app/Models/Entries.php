<?php
namespace App\Models;

use Core\Model;

class Entries extends Model
{

	function __construct()
	{	
		parent::__construct();
	}

	function getAll(){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."entry order by id desc ");
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function add($data){
		try {
			$this->db->insert(PREFIX.'entry',$data);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}


	function delete($id){
		try {
			$this->db->delete(PREFIX.'entry',array('id' => $id));
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

	function get($id){
		$data = null;
		try {
			$data = $this->db->select("SELECT E.*, U.username as 'username', F.name as 'facultyName', F.code as 'facultyCode' , fi.name as 'fileName' , fi.path as 'filePath' FROM ".PREFIX."entry E, user U, faculty F , file fi WHERE E.id = :id AND E.student = U.id AND E.faculty = F.id AND E.file = fi.id ORDER BY created_date DESC ",array(':id' => $id));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data[0];
	}

	function getEntries($faculty){
		$data = null;
		try {
			$data = $this->db->select("SELECT E.*, U.username as 'username', F.name as 'facultyName', F.code as 'facultyCode' , fi.name as 'fileName' , fi.path as 'filePath' FROM ".PREFIX."entry E, user U, faculty F , file fi WHERE E.faculty = :faculty AND E.student = U.id AND E.faculty = F.id AND E.file = fi.id  ORDER BY created_date DESC ",array(':faculty' => $faculty));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function getYourEntries($student,$status,$faculty){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."entry WHERE student =:student AND faculty = :faculty AND status =:status ORDER BY created_date DESC ",array(':student' => $student,":status" => $status,':faculty' => $faculty));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}


	function update($data,$where){
		try {
			$this->db->update(PREFIX."entry",$data,$where);
			return true;
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			return false;
		}
	}

	function getEntriesByCode($code,$name,$year){
		$data = null;
		try {
			$data = $this->db->select("SELECT * FROM ".PREFIX."entry WHERE status = 'approved' AND faculty IN ( SELECT id FROM ".PREFIX."faculty WHERE code =:code AND name=:name AND year =:year ORDER BY created_date DESC )",array(':code' => $code,':name' => $name,':year'=> $year));
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function getYear(){
		$data = null;
		try {
			$data = $this->db->select("SELECT DISTINCT year FROM ".PREFIX."faculty ORDER BY year DESC ");
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

	function getEntriesWithOutComment(){

	}

	function getEntriesWithOutComment14days(){

	}
}