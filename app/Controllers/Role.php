<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;

class Role extends Controller {	

	private $roles;

	public function __construct()
    {
        parent::__construct();
        $this->roles = new \App\Models\Roles();
    }

    public function index(){
        if(Session::get('admin') == null){
            Url::redirect('admin/login');
        }
    	$data['title'] = 'Role Management';
        $data['menu'] = 'user';
    	View::renderTemplate('header', $data);
        View::render('Role/Role', $data);
        View::renderTemplate('footer', $data);
    }

    public function getAll(){
    	echo json_encode($this->roles->getAll());
    }

    public function add(){
    	$name = $_POST['name'];
    	$description = $_POST['description'];

    	$data = array('name' => $name,'description' => $description );

    	echo json_encode($this->roles->add($data));
    }

    public function delete(){
    	$id = $_POST['itemId'];
    	echo json_encode($this->roles->delete($id));
    }

    public function get(){
    	$id = $_GET['itemId'];
    	echo json_encode($this->roles->get($id));
    }


    public function update(){
    	$name = $_POST['name'];
    	$description = $_POST['description'];
    	$id = $_POST['id'];

    	$data = array('name' => $name,'description' => $description );
    	$where = array('id' => $id);

    	echo json_encode($this->roles->update($data,$where));
    }

}