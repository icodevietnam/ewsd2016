<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

class HomeIndex extends Controller {	

	public function __construct()
    {
        parent::__construct();
    }

    public function index(){
    	$data['title'] = 'Home';
        //$data['levels'] = $this->levels->getAll();
        $data['banner'] = Url::imgPath().'library-banner.jpg';
    	View::renderTemplate('header', $data,'home');
        View::render('Home/Home', $data);
        View::renderTemplate('footer', $data,'home');
    }


}