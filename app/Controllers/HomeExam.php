<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

error_reporting(E_Error);

class HomeExam extends Controller {	

    private $levels;
    private $exams;
    private $questions;
    private $answers;

	public function __construct()
    {
        parent::__construct();
        $this->levels = new \App\Models\Levels();
        $this->exams = new \App\Models\Exams();
        $this->questions = new \App\Models\Questions();
        $this->answers = new \App\Models\Answers();
    }

    public function exam(){
    	$data['title'] = 'Exams';
        $data['levels'] = $this->levels->getAll();
    	View::renderTemplate('header', $data,'home');
        View::render('Home/Exam', $data);
        View::renderTemplate('footer', $data,'home');
    }

    public function test(){
        $questions = '';
        $level = $_GET['level'];
        $userId = $_GET['userId'];
        if($this->exams->checkExams($userId)){
            $data['title'] = 'Exams';
            $data['levels'] = $this->levels->getAll();
            $data['message'] = 'You have the exams did not complete. So you can not create new test.Go to History menu, and choose your exams is not finished';
            View::renderTemplate('header', $data,'home');
            View::render('Home/Exam', $data);
            View::renderTemplate('footer', $data,'home');
        }else{
            $name = 'test-'.$userId.'-'.$level.'-'.uniqid();
            $startDate = date("Y-m-d H:i:s");
            $endDate = date('Y-m-d H:i:s',strtotime('+15 minutes'));
            //Load 10 câu hỏi 1 lúc
            $listId = $this->surfQuestion($level);
            $total = 0;
            for ($i=count($listId)- 1; $i >=0 ; $i--) { 
                $questions .= $listId[$i]->id.'-';
                $total+= $listId[$i]->point; 
            }
            $questions = substr($questions,0,strlen($questions)-1);

            $entity = array('name'=>$name,'date_start'=>$startDate,'date_end'=>$endDate,'user'=>$userId,'level'=>$level,'question' => $questions,'total'=>$total,'result'=>0,'complete'=>0);
            $this->exams->add($entity);
            Url::redirect("code?code=".$name);
        }
    }

    public function reviewByCode(){
        $code = $_GET['code'];
        $listId = [];
        $data['title'] = 'Review';
        $exam = $this->exams->getExamsByCode($code);
        $dateStart = date('Y-m-d H:i:s', strtotime($exam[0]->date_start));
        $dateEnd = date('Y-m-d H:i:s', strtotime($exam[0]->date_end));
        $questions = $exam[0]->question;
        $questionArray = explode("-", $questions);
        for($i=0;$i < count($questionArray);$i++){
            $s1 = $this->questions->get($questionArray[$i]);
            $stdCls = new \stdClass();
            $stdCls->id = $s1[0]->id;
            $stdCls->name = $s1[0]->name;
            $stdCls->audio = $s1[0]->audio;
            $stdCls->description = $s1[0]->description;
            $stdCls->level = $s1[0]->level;
            $stdCls->point = $s1[0]->point;
            /*$answerArray = [];
            $answerArray = $this->answers->getAnswer($s1[0]->id);*/
            // $stdClass->answerArray = $answerArray;
            //echo json_encode($stdCls);
            array_push($listId, $stdCls);
        }
        $data['code'] = $exam[0]->name;
        $data['questions'] = $questions;
        $data['listId'] = $listId;
        $data['from'] =$dateStart;
        $data['to'] = $dateEnd;
        $data['backup'] = $exam[0]->backup;
        $data['total'] = $exam[0]->total;
        View::renderTemplate('header', $data,'home');
        View::render('Home/Review', $data);
        View::renderTemplate('footer', $data,'home');
    }

    public function testByCode(){
        //$userId = Session::get('user')[0]->id;
        $listId = [];
        $code = $_GET['code'];
        $data['title'] = 'Test';
        $exam = $this->exams->getExamsByCode($code);
        $dateStart = date('Y-m-d H:i:s', strtotime($exam[0]->date_start));
        $dateEnd = date('Y-m-d H:i:s', strtotime($exam[0]->date_end));
        $now = date("Y-m-d H:i:s");
        if(($now < $dateStart) || ($now > $dateEnd) || $exam[0]->complete == 1){
            $data['title'] = 'Exams';
            $data['levels'] = $this->levels->getAll();
            $data['message'] = 'This test is over, time up';
            View::renderTemplate('header', $data,'home');
            View::render('Home/Exam', $data);
            View::renderTemplate('footer', $data,'home');
        }else{
        $questions = $exam[0]->question;
        $questionArray = explode("-", $questions);
        for($i=0;$i < count($questionArray);$i++){
            $s1 = $this->questions->get($questionArray[$i]);
            $stdCls = new \stdClass();
            $stdCls->id = $s1[0]->id;
            $stdCls->name = $s1[0]->name;
            $stdCls->audio = $s1[0]->audio;
            $stdCls->description = $s1[0]->description;
            $stdCls->level = $s1[0]->level;
            $stdCls->point = $s1[0]->point;
            /*$answerArray = [];
            $answerArray = $this->answers->getAnswer($s1[0]->id);*/
            // $stdClass->answerArray = $answerArray;
            //echo json_encode($stdCls);
            array_push($listId, $stdCls);
        }
        $data['code'] = $exam[0]->name;
        $data['questions'] = $questions;
        $data['listId'] = $listId;
        $data['from'] =$dateStart;
        $data['to'] = $dateEnd;
        $data['total'] = $exam[0]->total;
        View::renderTemplate('header', $data,'home');
        View::render('Home/Test', $data);
        View::renderTemplate('footer', $data,'home');
        //echo json_encode($data['code']);
        }
    }

    //Length Question : so luong cau hoi
    //Level theo ID
    private function surfQuestion($level,$length = QUESTION ){
        $questionStr = '';
        $data = $this->questions->checkQuestionsByLevels($level);
        shuffle($data);
        $randomId = array_slice($data, 0,$length);
        return $randomId;
    }

    public function markTest(){
        $code = $_POST['name'];
        $length = QUESTION;
        $point = 0;
        $answerStr = '';
        for($i = 1; $i <= $length ; $i++){
            $questionId = $_POST['questions-'.$i];
            $question = $this->questions->get($questionId);
            $listAnswers = $this->answers->getAnswer($questionId);
            if($this->answers->checkAnswer($questionId) === true){
                $answerArr = $_POST['answer-'.$i];
                if($answerArr !== null){
                    for($j=0;$j<count($answerArr);$j++){
                        $answerStr .= $answerArr[$j].',';
                    }
                }
                $correctArr =[];
                foreach ($listAnswers as $key => $value){
                    if($value->correct == 1){
                        array_push($correctArr,$value->id);
                    }
                }

                if($correctArr == $answerArr){
                    $point+=$question[0]->point;
                }
               
            }else{
                $answerId = $_POST['answer-'.$i];
                if($answerId !== null){
                    $answerStr .= $answerId.',';
                    foreach ($listAnswers as $key => $value) { 
                        if($value->id == $answerId && $value->correct == 1){
                            $point+=$question[0]->point;
                        }
                    }
                }
            }
        }
        $answerStr = substr($answerStr,0,strlen($answerStr)-1);
        $data = array('result' => $point,'complete' => 1,'backup'=>$answerStr);
        $where = array('name' => $code);
        $this->exams->update($data,$where);
        echo json_encode($point);
    }

}