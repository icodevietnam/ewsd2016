<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

class HomeTest extends Controller {	

	public function __construct()
    {
        parent::__construct();
    }

    /*public function index(){
    	$data['title'] = 'Test';
        //$data['levels'] = $this->levels->getAll();
    	View::renderTemplate('header', $data,'home');
        View::render('Home/Test', $data);
        View::renderTemplate('footer', $data,'home');
    }

    public function index(){
        $data['title'] = 'Test';
        //$data['levels'] = $this->levels->getAll();
        View::renderTemplate('header', $data,'home');
        View::render('Home/Test', $data);
        View::renderTemplate('footer', $data,'home');
    }*/

}