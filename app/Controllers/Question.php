<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

class Question extends Controller {	

	private $questions;
    private $levels;
    private $answers;

	public function __construct()
    {
        parent::__construct();
        $this->questions = new \App\Models\Questions();
        $this->levels = new \App\Models\Levels();
        $this->answers = new \App\Models\Answers();
    }

    public function index(){
        if(Session::get('admin') == null){
            Url::redirect('admin/login');
        }
    	$data['title'] = 'Question & Answer Management';
        $data['menu'] = 'exam';
        $data['levels'] = $this->levels->getAll();
    	View::renderTemplate('header', $data);
        View::render('Question/Question', $data);
        View::renderTemplate('footer', $data);
    }

    public function getAll(){
    	echo json_encode($this->questions->getAll());
    }

    public function add(){
    	$name = $_POST['name'];
    	$description = $_POST['description'];
        $level  = $_POST['level'];
        $point = $_POST['point'];
        $upload = new \Helpers\UploadCoded();
        $audio = $upload->upload('audio','image|audio',20480000);
        $fileName = $_FILES['audio']['name'];

        if("" === $fileName){
            $data = array('name' => $name,'description' => $description,'level' => $level,'audio' => 'Do not attach the audio file','point' => $point);
        }else{
            $data = array('name' => $name,'description' => $description,'level' => $level,'audio' => $audio,'point' => $point);
        }
    	echo json_encode($this->questions->add($data));
    }

    public function delete(){
    	$id = $_POST['itemId'];
    	echo json_encode($this->questions->delete($id));
    }

    public function get(){
    	$id = $_GET['itemId'];
    	echo json_encode($this->questions->get($id));
    }


    public function update(){
    	$id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $level  = $_POST['level'];
        $upload = new \Helpers\UploadCoded();
        $audio = $upload->upload('audio','audio',20480000);
        $point = $_POST['point'];
        $fileName = $_FILES['audio']['name'];

    	if("" === $fileName){
            $data = array('name' => $name,'description' => $description,'level' => $level,'point' => $point);
        }else{
            $data = array('name' => $name,'description' => $description,'level' => $level,'audio' => $audio,'point' => $point);
        }
    	$where = array('id' => $id);

    	echo json_encode($this->questions->update($data,$where));
    }

    public function getAnswerbyID(){
        $questionId = $_GET['questionId'];
        echo json_encode($this->answers->getAnswers($questionId));
    }

    public function addAns(){
        $name = $_POST['name'];
        $correct = $_POST['correct'];
        $questionId  = $_POST['questionId'];
        $intCorrect = 0;

        if($correct == 'true'){
            $intCorrect = 1;
        }else{
            $intCorrect = 0;
        }

        $data = array('name' => $name,'correct' => $intCorrect,'question' => $questionId);
        echo json_encode($this->answers->add($data));
    }

    public function deleteAns(){
        $id = $_POST['itemId'];
        echo json_encode($this->answers->delete($id));
    }

    public function getAns(){
        $id = $_GET['itemId'];
        echo json_encode($this->answers->get($id));
    }

    public function updateAns(){
        $id = $_POST['itemId'];

        $name = $_POST['name'];
        $correct = $_POST['correct'];
        $questionId  = $_POST['questionId'];
        $intCorrect = 0;

        if($correct == 'true'){
            $intCorrect = 1;
        }else{
            $intCorrect = 0;
        }
        $data = array('name' => $name,'correct' => $intCorrect,'question' => $questionId);
        $where = array('id' => $id);
        echo json_encode($this->answers->update($data,$where));
    }

    function getAnswer(){
        $questionId = $_GET['questionId'];
        echo json_encode($this->answers->getAnswer($questionId));
    }

    function checkAnswer(){
        $questionId = $_GET['questionId'];
        echo json_encode($this->answers->checkAnswer($questionId));
    }


}