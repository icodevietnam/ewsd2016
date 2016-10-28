<?php
namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;


class Profile extends Controller {	

    private $users;

	public function __construct()
    {
        parent::__construct();
        $this->users = new \App\Models\Users();
    }

    public function profile(){
        if(Session::get('admin') == null){
            Url::redirect('admin/login');
        }
        $id = Session::get('admin')[0]->id;
    	$data['title'] = 'Profile';
        $data['user'] = $this->users->get($id);
    	View::renderTemplate('header', $data);
        View::render('Profile/Profile', $data);
        View::renderTemplate('footer', $data);
    }

    public function changePassword(){
        if(Session::get('admin') == null){
            Url::redirect('admin/login');
        }
        $data['title'] = 'Change Password';
        $id = Session::get('admin')[0]->id;
        $data['user'] = $this->users->get($id);
        View::renderTemplate('header', $data);
        View::render('Profile/ChangePassword', $data);
        View::renderTemplate('footer', $data);
    }

    public function updateProfile(){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $fullName = $_POST['fullname'];
        $email = $_POST['email'];
        $upload = new \Helpers\UploadCoded();
        $avatar = $upload->upload('avatar','image');
        $fileName = $_FILES['avatar']['name'];
        if("" === $fileName){
            $data = array('username' => $username,'fullname' => $fullName,'email' => $email);
        }else{
            $data = array('username' => $username,'fullname' => $fullName,'email' => $email,'avatar' => $avatar );
        }

        $where = array('id' => $id);
        $admin = $this->users->update($data,$where);
        echo json_encode($admin);
    }

    public function changeMyPassword(){
        $id = $_POST['id'];
        $password = $_POST['newPassword'];

        $data = array('password' => md5($password));
        $where = array('id' => $id);

        $admin = $this->users->update($data,$where);
        Session::destroy();
        echo json_encode($admin);
    }

}