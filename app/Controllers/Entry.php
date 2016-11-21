<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

class Entry extends Controller {	

    private $entries;
    private $files;
    private $faculties;

	public function __construct()
    {
        parent::__construct();
        $this->entries = new \App\Models\Entries();
        $this->faculties = new \App\Models\Faculties();
        $this->files = new  \App\Models\Files();
    }

    public function add(){
        $student = Session::get('student');
        $name = $_POST['name'];
        $description = $_POST['description'];
        $content = $_POST['content'];
        $upload = new \Helpers\UploadCoded();
        $file = $upload->uploadFile($_FILES['file']);
        $image = $upload->uploadFile($_FILES['image']);
        $insertFile = $this->files->add($file);
        $rowFile = null;
        if($insertFile){
            $rowFile = $this->files->getFileByName($file['name']);
        }
        $data = array('name' => $name,'description' => $description,'content' => $content,'faculty'=> Session::get('student')[0]->faculty ,'student' => Session::get('student')[0]->id ,'status'=>STATUS_NON_APPROVED,'img'=>$image['path'],'file'=>$rowFile->id);
        echo json_encode($this->entries->add($data));
    }

    public function getAll(){
        echo json_encode($this->entries->getAll());
    }

    public function yourEntries(){
        $facultyValue = Session::get('student')[0]->faculty;
        $faculty = $this->faculties->get($facultyValue);
        $status = $_GET['status'];
        if($status == ''){
            $status = STATUS_APPROVED;
        }

        $data['title'] = 'Entries of '.Session::get('student')[0]->username;
        $data['lead'] = 'Check your Entries ';
        $data['slogan'] = "Your Entries";
        $data['heading'] = 'Your Entries - '.$faculty[0]->name.' [ '.$faculty[0]->code.' ] ';
        $data['banner'] = Url::imgPath().'library-banner.jpg';
        $currentYear = date('Y');
        $listFaculties = $this->faculties->getFacultiesByYear($currentYear);
        $data['listFaculties'] = $listFaculties;
        View::renderTemplate('header', $data,'Home');
        View::render('Home/YourEntry', $data);
        View::renderTemplate('footer', $data,'Home');
    }

    public function getYourEntries(){
        $student = Session::get('student')[0]->id;
        $faculty = Session::get('student')[0]->faculty;
        $status = $_GET['status'];
        if($status == ''){
            $status = STATUS_APPROVED;
        }
        $listEntries = $this->entries->getYourEntries($student,$status,$faculty);
        echo json_encode($listEntries);
    }
    //Faculty Page
    public function facultyPage($code){
        $faculty = $this->faculties->getFacultyByCode($code);
        if(count($faculty)!=0){
            $data['title'] = $faculty->code;
            $data['lead'] = $faculty->name;
            $data['slogan'] = $faculty->description;
            $data['heading'] = 'Your Entries - '.$faculty->name.' [ '.$faculty->code.' ] ';
            $data['banner'] = Url::imgPath().'library-banner.jpg';
            $currentYear = date('Y');
            $listFaculties = $this->faculties->getFacultiesByYear($currentYear);
            $data['listFaculties'] = $listFaculties;
            $data['facultyCode'] =  $code;
            $data['facultyName'] = $faculty->name;
            $listYear = $this->entries->getYear();
            $data['listYear'] = $listYear;
            View::renderTemplate('header', $data,'Home');
            View::render('Home/Faculty', $data);
            View::renderTemplate('footer', $data,'Home');
        }
    }

    public function getFacultyPage(){
        $code = $_GET['code'];
        $year = $_GET['year'];
        $name = $_GET['name'];
        $listEntries = $this->entries->getEntriesByCode($code,$name,$year);
        echo json_encode($listEntries);
    }

}