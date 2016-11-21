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
    		Url::redirect('admin/statistics');
    	}
    	$data['title'] = 'Login';
    	View::renderTemplate('header', $data,'Login');
        View::render('Login/Login', $data);
        View::renderTemplate('footer', $data,'Login');
    }

    //Login Admin
    public function loginConsole(){
    	$username = $_POST['username'];
    	$password = $_POST['password'];

    	$admin = $this->users->loginConsole($username,md5($password));
    	//Save Session
    	if($admin !=null){
    		Session::set('admin',$admin);
    		Url::redirect('admin/statistics');
    	}
    	else{
            $data['err'] = "Username and password was wrong.";
            View::renderTemplate('header', $data,'Login');
            View::render('Login/Login', $data);
            View::renderTemplate('footer', $data,'Login');
    	}
    }

    //Login User
    public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->users->login($username,md5($password));
        //Save Session
        if($user !=null){
            Session::set('student',$user);
            Url::redirect('home');
        }else{
            $data['message'] =  "Can't login because username or password input wrongly.";
            View::renderTemplate('header',$data,'Signup');
            View::render('Login/HomeLogin', $data);
            View::renderTemplate('footer',$data,'Signup');
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