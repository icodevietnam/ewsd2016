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
    	View::renderTemplate('header', $data,'Home');
        View::render('Home/Home', $data);
        View::renderTemplate('footer', $data,'Home');
    }

    public function aboutUsPage(){
        $data['title'] = 'Contact Us';
        $data['lead'] = "Contact Us";
        $data['slogan'] = "Connecting People";
        $data['banner'] = Url::imgPath().'library-banner.jpg';
        $currentYear = date('Y');
        $listFaculties = $this->faculties->getFacultiesByYear($currentYear);
        $data['listFaculties'] = $listFaculties;
        View::renderTemplate('header', $data,'Home');
        View::render('Home/AboutUs', $data);
        View::renderTemplate('footer', $data,'Home');
    }

    public function facultyPage($code){
        $faculty = $this->faculties->getFacultyByCode($code);
        if(count($faculty)!=0){
            $data['title'] = $faculty->code;
            $data['lead'] = $faculty->name;
            $data['slogan'] = $faculty->description;
            $data['banner'] = Url::imgPath().'library-banner.jpg';
            $currentYear = date('Y');
            $listFaculties = $this->faculties->getFacultiesByYear($currentYear);
            $data['listFaculties'] = $listFaculties;
            View::renderTemplate('header', $data,'Home');
            View::render('Home/Faculty', $data);
            View::renderTemplate('footer', $data,'Home');
        }
    }

    public function loginAndSignUpPage(){
        View::renderTemplate('header',$data,HOMELOGIN);
        View::render('Login/HomeLogin', $data);
        View::renderTemplate('footer',$data,HOMELOGIN);
    }

    public function viewEntry(){
        $faculty = $this->faculties->getFacultyByCode($code);
        if(count($faculty)!=0){
            $data['title'] = 'Contact Us';
            $data['lead'] = "Contact Us";
            $data['slogan'] = "Connecting People";
            $data['banner'] = Url::imgPath().'library-banner.jpg';
            $currentYear = date('Y');
            $listFaculties = $this->faculties->getFacultiesByYear($currentYear);
            $data['listFaculties'] = $listFaculties;
            View::renderTemplate('header', $data,'Home');
            View::render('Home/ViewEntry', $data);
            View::renderTemplate('footer', $data,'Home');
        }
    }


}