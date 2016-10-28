<?php
namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;


class Level extends Controller {	

    private $levels;

	public function __construct()
    {
        parent::__construct();
        $this->levels = new \App\Models\Levels();
    }

    public function index(){
        if(Session::get('admin') == null){
            Url::redirect('admin/login');
        }
    	$data['title'] = 'Level Management';
        $data['menu'] = 'exam';
    	View::renderTemplate('header', $data);
        View::render('Level/Level', $data);
        View::renderTemplate('footer', $data);
    }

    public function getAll(){
        echo json_encode($this->levels->getAll());
    }

    public function add(){
        $name = $_POST['name'];
        $description = $_POST['description'];

        $data = array('name' => $name,'description' => $description );

        echo json_encode($this->levels->add($data));
    }

    public function delete(){
        $id = $_POST['itemId'];
        echo json_encode($this->levels->delete($id));
    }

    public function get(){
        $id = $_GET['itemId'];
        echo json_encode($this->levels->get($id));
    }


    public function update(){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $id = $_POST['id'];

        $data = array('name' => $name,'description' => $description );
        $where = array('id' => $id);

        echo json_encode($this->levels->update($data,$where));
    }

}