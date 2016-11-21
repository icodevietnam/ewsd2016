<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

class Contact extends Controller {	


	public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        if(Session::get('admin') == null){
            Url::redirect('admin/login');
        }
        $data['title'] = 'Contact Us';
        $data['menu'] = 'preference';
    	View::renderTemplate('header', $data);
        View::render('Contact/Contact', $data);
        View::renderTemplate('footer', $data);
    }

}