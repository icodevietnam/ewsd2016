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
    private $comments;
    private $roles;

	public function __construct()
    {
        parent::__construct();
        $this->entries = new \App\Models\Entries();
        $this->faculties = new \App\Models\Faculties();
        $this->files = new  \App\Models\Files();
        $this->comments = new  \App\Models\Comments();
        $this->roles = new \App\Models\Roles();
    }

    public function index(){
        if(Session::get('admin') == null){
            Url::redirect('admin/login');
        }
        $data['title'] = 'Entry Management';
        $data['menu'] = 'faculty';
        $data['faculties'] = $this->faculties->getAll();
        View::renderTemplate('header', $data);
        View::render('Entry/Entry', $data);
        View::renderTemplate('footer', $data);
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

    public function viewEntry(){
        $entryId = $_GET['id'];
        $entry = $this->entries->get($entryId);
        $data['title'] = 'Detail of Entries';
        $data['lead'] = 'Your Entries ';
        $data['slogan'] = "Your Entries";
        $data['heading'] = $entry->name;
        $data['banner'] = Url::imgPath().'library-banner.jpg';
        $currentYear = date('Y');
        $listFaculties = $this->faculties->getFacultiesByYear($currentYear);
        $data['listFaculties'] = $listFaculties;
        $data['entry'] = $entry;
        $data['files'] = $this->files->get($entry->file);
        $data['comments'] = $this->comments->getByEntry($entry->id);
        View::renderTemplate('header', $data,'Home');
        View::render('Home/ViewEntry', $data);
        View::renderTemplate('footer', $data,'Home');
    }

    function getFaculty(){
        $roleCode = Session::get('admin')[0]->roleCode;
        $entries = null;
        if($roleCode=='mkcoor'){
            $faculty = $this->faculties->getFaculty(Session::get('admin')[0]->id);
            $entries = $this->entries->getEntries($faculty->id);
        }else{
            $facultyId = $_GET['faculty'];
            $entries = $this->entries->getEntries($facultyId);
        }
        echo json_encode($entries);
    }

    function preReviewCode(){
        $id = $_GET['id'];
        $reviewer = Session::get("admin")[0]->id; 
        $entry = $this->entries->get($id);
        if($entry->status === STATUS_NON_APPROVED){
            $status = STATUS_IS_REVIEWED;
        }else{
            $status = $entry->status;
        }
        $data = array("status" => $status,"reviewer" => $reviewer);
        $where = array("id"=>$id);
        $this->entries->update($data,$where);
        $entry = $this->entries->get($id);
        echo json_encode($entry);
    }

    function checkCode(){
        $status = $_POST["status"];
        $reviewer = Session::get("admin")[0]->id;
        $entryId = $_POST["id"];
        $entry = $this->entries->get($entryId);
        $comment = $_POST["comment"];
        $dataComment = array("user"=>$reviewer,"name"=>"Feedback about ".$entry->name,"comment"=>$comment,"entry"=>$entryId);
        $this->comments->add($dataComment);
        $data = array("status"=>$status);
        $where = array("id"=> $entryId);
        $this->entries->update($data,$where);
        echo json_encode(true);
    }

}