<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

class Notification extends Controller {	

	private $news;

	public function __construct()
    {
        parent::__construct();
        $this->news = new \App\Models\News();
    }

    public function index(){
        if(Session::get('admin') == null){
            Url::redirect('admin/login');
        }
    	$data['title'] = 'Notification Management';
        $data['menu'] = 'user';
    	View::renderTemplate('header', $data);
        View::render('Notification/Notification', $data);
        View::renderTemplate('footer', $data);
    }

    public function index2(){
        if(Session::get('admin') == null){
            Url::redirect('admin/login');
        }
    	$data['title'] = 'News Management';
        $data['menu'] = 'user';
    	View::renderTemplate('header', $data);
        View::render('News/News', $data);
        View::renderTemplate('footer', $data);
    }

    public function getAll(){
    	echo json_encode($this->news->getAllNotifications());
    }

    public function getAllNews(){
    	echo json_encode($this->news->getAllNews());
    }

    public function delete(){
    	$id = $_POST['itemId'];
    	echo json_encode($this->news->delete($id));
    }

    public function get(){
        $id = $_GET['itemId'];
        echo json_encode($this->news->get($id));
    }

    public function addNotification(){
    	$title = $_POST['title'];
    	$description = $_POST['description'];
    	$content = $_POST['content'];
    	$fileName = $_FILES['image']['name'];
    	$upload = new \Helpers\UploadCoded();
    	$image = $upload->upload('image','image');

    	if("" === $fileName){
            $data = array('title' => $title, 'description' => $description,'content' => htmlspecialchars($content),'type' => 1,'image' => 'http://localhost/cat-prj/assets/images/default.png');
        }else{
            $data = array('title' => $title, 'description' => $description,'content' => htmlspecialchars($content),'type' => 1,'image' => $image);
        }

        echo json_encode($this->news->add($data));
    }

    public function update(){
        $id = $_POST['id'];
        $title = $_POST['title'];
    	$description = $_POST['description'];
    	$content = $_POST['content'];
    	$fileName = $_FILES['image']['name'];
    	$upload = new \Helpers\UploadCoded();
    	$image = $upload->upload('image','image');
        if("" === $fileName){
            $data = array('title' => $title, 'description' => $description,'content' => htmlspecialchars($content));
        }else{
            $data = array('title' => $title, 'description' => $description,'content' => htmlspecialchars($content),'image' => $image);
        }

        $where = array('id' => $id);

        echo json_encode($this->news->update($data,$where));
    }

    public function addNews(){
    	$title = $_POST['title'];
    	$description = $_POST['description'];
    	$content = $_POST['content'];
    	$fileName = $_FILES['image']['name'];
    	$upload = new \Helpers\UploadCoded();
    	$image = $upload->upload('image','image');

    	if("" === $fileName){
            $data = array('title' => $title, 'description' => $description,'content' => htmlspecialchars($content),'type' => 0,'image' => 'http://localhost/cat-prj/assets/images/default.png');
        }else{
            $data = array('title' => $title, 'description' => $description,'content' => htmlspecialchars($content),'type' => 0,'image' => $image);
        }

        echo json_encode($this->news->add($data));
    }
}