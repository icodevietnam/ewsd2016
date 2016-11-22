<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

class Comment extends Controller {	

	private $files;
    private $comments;
    private $entries;

	public function __construct()
    {
        parent::__construct();
        $this->files = new \App\Models\Files();
        $this->comments = new \App\Models\Comments();
        $this->entries = new \App\Models\Entries();
    }

    public function getAll(){
    	echo json_encode($this->files->getAll());
    }

    public function add(){
    	// $name = $_POST['name'];
    	// $description = $_POST['description'];
        // $code = $_POST['code'];
    	// $data = array('name' => $name,'description' => $description,'code' => $code);
    	echo json_encode($this->files->add($data));
    }

    public function delete(){
    	$id = $_POST['itemId'];
    	echo json_encode($this->files->delete($id));
    }

    public function get(){
    	$id = $_GET['itemId'];
    	echo json_encode($this->files->get($id));
    }


    public function update(){
    	$name = $_POST['name'];
    	$description = $_POST['description'];
        $code = $_POST['code'];
        
    	$id = $_POST['id'];

    	$data = array('name' => $name,'description' => $description,'code' => $code);
    	$where = array('id' => $id);

    	echo json_encode($this->files->update($data,$where));
    }

    public function getByEntry(){
        $entryId = $_GET['id'];
        $listEntries = $this->comments->getByEntry($entryId);
        echo json_encode($listEntries);
    }

}