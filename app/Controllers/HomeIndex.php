<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;
use Helpers\Session;
use Helpers\Url;

class HomeIndex extends Controller {	

    private $faculties;

	public function __construct()
    {
        parent::__construct();
        $this->faculties = new \App\Models\Faculties();
    }

    public function index(){
    	$data['title'] = 'Home';
        $data['lead'] = "Contribution System";
        $data['slogan'] = "Make People to be Creative ...";
        $data['banner'] = Url::imgPath().'library-banner.jpg';
        $currentYear = date('Y');
        $listFaculties = $this->faculties->getFacultiesByYear($currentYear);
        $data['listFaculties'] = $listFaculties;
    	View::renderTemplate('header', $data,'home');
        View::render('Home/Home', $data);
        View::renderTemplate('footer', $data,'home');
    }

    public function aboutUsPage(){
        $data['title'] = 'Contact Us';
        $data['lead'] = "Contact Us";
        $data['slogan'] = "Connecting People";
        $data['banner'] = Url::imgPath().'library-banner.jpg';
        $currentYear = date('Y');
        $listFaculties = $this->faculties->getFacultiesByYear($currentYear);
        $data['listFaculties'] = $listFaculties;
        View::renderTemplate('header', $data,'home');
        View::render('Home/AboutUs', $data);
        View::renderTemplate('footer', $data,'home');
    }


    private function facultiesByYear($year){
        $listFaculties = $this->faculties->getFacultiesByYear($year);
        return listFaculties;
    }


}