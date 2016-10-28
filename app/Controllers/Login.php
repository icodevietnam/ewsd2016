<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

/**
* 
*/
class Login extends Controller{
	
	private $users;

	public function __construct()
    {
        parent::__construct();
        $this->users = new \App\Models\Users();
    }

    public function index(){
    	if(Session::get('admin') != null){
    		Url::redirect('admin/dashboard');
    	}
    	$data['title'] = 'Login';
    	View::renderTemplate('header', $data,'login');
        View::render('Login/Login', $data);
        View::renderTemplate('footer', $data,'login');
    }

    //Login Admin
    public function loginAdmin(){
    	$username = $_POST['username'];
    	$password = $_POST['password'];

    	$admin = $this->users->loginAdmin($username,md5($password));
    	//Save Session
    	if($admin !=null){
    		Session::set('admin',$admin);
    		Url::redirect('admin/dashboard');
    	}
    	else{
            $data['err'] = "Username and password was wrong.";
            View::renderTemplate('header', $data,'login');
            View::render('Login/Login', $data);
            View::renderTemplate('footer', $data,'login');
    	}
    }

    //Login User
    public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->users->login($username,md5($password));
        //Save Session
        if($user !=null){
            Session::set('user',$user);
            echo json_encode('home');
        }else{
            echo json_encode('false');
        }
    }


    //Log Out Admin
    public function logOutAdmin(){
    	Session::destroy();
    	Url::redirect('admin/login');
    }

    public function logOut(){
        Session::destroy();
        Url::redirect('home');
    }

}