<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

class Faculty extends Controller {	

	private $faculties;
    private $years;
    private $users;

	public function __construct()
    {
        parent::__construct();
        $this->faculties = new \App\Models\Faculties();
        $this->users=  new \App\Models\Users();
    }

    public function index(){
        if(Session::get('admin') == null){
            Url::redirect('admin/login');
        }
    	$data['title'] = 'Faculty Management';
        $data['menu'] = 'faculty';
        $currentYear = date('Y');
        $years = array($currentYear,$currentYear - 1);
        $data['years'] = $years;
    	View::renderTemplate('header', $data);
        View::render('Faculty/Faculty', $data);
        View::renderTemplate('footer', $data);
    }

    public function reloadMkcoor(){
        $countFaculties = $this->faculties->getAll();
        $listMkcoor = $this->users->getCoordinatorWithoutManage('mkcoor',count($countFaculties));
        echo json_encode($listMkcoor);
    }

    public function getAll(){
    	echo json_encode($this->faculties->getAll());
    }

    public function add(){
    	$name = $_POST['name'];
    	$description = $_POST['description'];
        $code = $_POST['code'];
        $year = $_POST['year'];
        $mkcoor = $_POST['mkcoor'];
    	$data = array('name' => $name,'description' => $description,'code' => $code,'year' => $year,'mkt_coor' => $mkcoor);
    	echo json_encode($this->faculties->add($data));
    }

    public function delete(){
    	$id = $_POST['itemId'];
    	json_encode($this->faculties->delete($id));
    }

    public function get(){
    	$id = $_GET['itemId'];
    	echo json_encode($this->faculties->get($id));
    }


    public function update(){
    	$name = $_POST['name'];
    	$description = $_POST['description'];
        $code = $_POST['code'];
        $year = $_POST['year'];
        $mkcoor = $_POST['mkcoor'];
    	$id = $_POST['id'];

    	$data = array('name' => $name,'description' => $description,'code' => $code,'year' => $year,'mkt_coor' => $mkcoor);
    	$where = array('id' => $id);

    	echo json_encode($this->faculties->update($data,$where));
    }

    public function getEntriesByEachAcademicYear(){
        echo json_encode($this->faculties->getEntriesByEachAcademicYear());
    }

    public function getContributorsByEachAcademicYear(){
        echo json_encode($this->faculties->getContributorsByEachAcademicYear());
    }

}