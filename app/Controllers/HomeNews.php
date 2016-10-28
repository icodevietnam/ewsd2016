<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

class HomeNews extends Controller {	

    private $news;

	public function __construct()
    {
        parent::__construct();
        $this->news = new \App\Models\News();
    }

    public function news(){
    	$data['title'] = 'News';
        //$data['levels'] = $this->levels->getAll();
        $data['news'] = $this->news->getAllNews();
    	View::renderTemplate('header', $data,'home');
        View::render('Home/News', $data);
        View::renderTemplate('footer', $data,'home');
    }

    public function notifications(){
        $data['title'] = 'Notification';
        //$data['levels'] = $this->levels->getAll();
        $data['notifications'] = $this->news->getAllNotifications();
        View::renderTemplate('header', $data,'home');
        View::render('Home/Notification', $data);
        View::renderTemplate('footer', $data,'home');
    }


}