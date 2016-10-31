<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;

class Faculty extends Controller {	

	private $faculties;

	public function __construct()
    {
        parent::__construct();
        $this->faculties = new \App\Models\Faculties();
    }

    public function index(){
        if(Session::get('admin') == null){
            Url::redirect('admin/login');
        }
    	$data['title'] = 'Faculty Management';
        $data['menu'] = 'user';
    	View::renderTemplate('header', $data);
        View::render('Faculty/Faculty', $data);
        View::renderTemplate('footer', $data);
    }

    public function getAll(){
    	echo json_encode($this->faculties->getAll());
    }

    public function add(){
    	$name = $_POST['name'];
    	$description = $_POST['description'];
        $code = $_POST['code'];
    	$data = array('name' => $name,'description' => $description,'code' => $code);
    	echo json_encode($this->faculties->add($data));
    }

    public function delete(){
    	$id = $_POST['itemId'];
    	echo json_encode($this->faculties->delete($id));
    }

    public function get(){
    	$id = $_GET['itemId'];
    	echo json_encode($this->faculties->get($id));
    }


    public function update(){
    	$name = $_POST['name'];
    	$description = $_POST['description'];
        $code = $_POST['code'];
        
    	$id = $_POST['id'];

    	$data = array('name' => $name,'description' => $description,'code' => $code);
    	$where = array('id' => $id);

    	echo json_encode($this->faculties->update($data,$where));
    }

}