<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

class Notification extends Controller {	


	public function __construct()
    {
        parent::__construct();
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

}