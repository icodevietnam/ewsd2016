<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

class Notification extends Controller {	

    private $notifications;
    private $faculties;

	public function __construct()
    {
        parent::__construct();
        $this->notifications = new \App\Models\Notifications();
        $this->faculties = new \App\Models\Faculties();
    }

    public function index(){
        if(Session::get('admin') == null){
            Url::redirect('admin/login');
        }
        $data['title'] = 'Notification Management';
        $data['menu'] = 'faculty';
        View::renderTemplate('header', $data);
        View::render('Notification/Notification', $data);
        View::renderTemplate('footer', $data);
    }

    public function getAll(){
        $uId = Session::get('admin')[0]->id;
        $faculty = $this->faculties->getFaculty($uId);
        echo json_encode($this->notifications->getByFaculty($faculty->id));
    }


    public function countInbox(){
        $count = 0;
        $uId = Session::get('admin')[0]->id;
        $faculty = $this->faculties->getFaculty($uId);
        if($faculty != null){
            $count = $this->notifications->getNotificationByFaculty($faculty->id);
        }
        echo json_encode($count->count);
    }


    public function get(){
        $id = $_GET['itemId'];
        echo json_encode($this->notifications->get($id));
    }

    public function read(){
        $id = $_POST['id'];
        $data = array('status' => 'read');
        $where = array('id'=>$id);
        echo json_encode($this->notifications->update($data,$where));
    }

}