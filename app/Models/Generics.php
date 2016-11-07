<?php
namespace app\Models;

use Core\Model;

class Generics extends Model
{
	function __construct()
	{	
		parent::__construct();
	}

	function countTable($table){
		$data = null;
		try {
			$data = $this->db->select("SELECT COUNT(1) AS 'COUNT_NUMBER' FROM ".PREFIX.$table." order by id desc ");
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}

}