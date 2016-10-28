<?php
namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

class User extends Controller {	

    private $users;
    private $roles;

	public function __construct()
    {
        parent::__construct();
        $this->users = new \App\Models\Users();
        $this->roles = new \App\Models\Roles();
    }

    public function index(){
        if(Session::get('admin') == null){
            Url::redirect('admin/login');
        }
    	$data['title'] = 'User Management';
        $data['menu'] = 'user';
        $data['roles'] = $this->roles->getAll();
    	View::renderTemplate('header', $data);
        View::render('User/User', $data);
        View::renderTemplate('footer', $data);
    }

    public function getAll(){
        echo json_encode($this->users->getAll());
    }

    public function add(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullName = $_POST['fullName'];
        $birthDate = $_POST['birthDate'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $upload = new \Helpers\UploadCoded();
        $avatar = $upload->upload('avatar','image');
        $birthDate = date('Y-m-d',strtotime($birthDate));
        $fileName = $_FILES['avatar']['name'];

        if("" === $fileName){
            $data = array('username' => $username, 'password' => md5($password) ,'fullname' => $fullName,'birthdate' => $birthDate,'email' => $email,'avatar' => 'http://localhost/cat-prj/assets/images/default.png','role' => $role);
        }else{
            $data = array('username' => $username, 'password' => md5($password) ,'fullname' => $fullName,'birthdate' => $birthDate,'email' => $email,'avatar' => $avatar ,'role' => $role );
        }
        echo json_encode($this->users->add($data));
    }

    public function delete(){
        $id = $_POST['itemId'];
        echo json_encode($this->users->delete($id));
    }

    public function get(){
        $id = $_GET['itemId'];
        echo json_encode($this->users->get($id));
    }


    public function update(){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $fullName = $_POST['fullName'];
        $birthDate = $_POST['birthDate'];
        $email = $_POST['email'];
        $upload = new \Helpers\UploadCoded();
        $avatar = $upload->upload('avatar','image');
        $birthDate = date('Y-m-d',strtotime($birthDate));
        $role = $_POST['role'];
        $fileName = $_FILES['avatar']['name'];
        if("" === $fileName){
            $data = array('username' => $username,'fullname' => $fullName,'birthdate' => $birthDate,'email' => $email,'role' => $role);
        }else{
            $data = array('username' => $username,'fullname' => $fullName,'birthdate' => $birthDate,'email' => $email,'avatar' => $avatar,'role' => $role );
        }

        $where = array('id' => $id);

        echo json_encode($this->users->update($data,$where));
    }

    public function checkEmailExist(){
        $email = $_GET['email'];
        echo json_encode($this->users->checkEmail($email));
    }


    public function checkUsernameExist(){
        $username = $_GET['username'];
        echo json_encode($this->users->checkUsername($username));
    }

    public function checkPasswordExist(){
        $oldPassword = $_GET['oldPassword'];
        $id = $_GET['id'];
        //echo json_encode(md5(oldPassword));
        echo json_encode($this->users->checkPassword(md5($oldPassword),$id));
    }

    public function createStudent(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullName = $_POST['fullname'];
        $birthDate = $_POST['birthDate'];
        $email = $_POST['email'];
        $upload = new \Helpers\UploadCoded();
        $avatar = $upload->upload('avatar','image');
        $birthDate = date('Y-m-d',strtotime($birthDate));
        $fileName = $_FILES['avatar']['name'];

        if("" === $fileName){
            $data = array('username' => $username, 'password' => md5($password) ,'fullname' => $fullName,'birthdate' => $birthDate,'email' => $email,'avatar' => 'http://localhost/cat-prj/assets/images/default.png');
        }else{
            $data = array('username' => $username, 'password' => md5($password) ,'fullname' => $fullName,'birthdate' => $birthDate,'email' => $email,'avatar' => $avatar );
        }

        $user = $this->users->add($data);

        Session::set('user',$user);
        echo json_encode($user);
    }
}