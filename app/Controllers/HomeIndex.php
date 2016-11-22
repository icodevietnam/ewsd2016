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
        $data['slogan'] = "People Contribution";
        $data['banner'] = Url::imgPath().'banner1.jpg';
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


    public function loginAndSignUpPage(){
        $faculties = $this->faculties->getAll();
        $data['title'] = 'Contribution System';
        $data['faculties'] = $faculties;
        View::renderTemplate('header',$data,'Signup');
        View::render('Login/HomeLogin', $data);
        View::renderTemplate('footer',$data,'Signup');
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

    public function createEntry(){
        if(Session::get('student') == null){
            Url::redirect('home');
        }
        $faculty = $this->faculties->getFacultyByCode($code);
        $data['title'] = 'Create Entry';
        $data['lead'] = "Create Entry";
        $data['slogan'] = "You can write your entry ...";
        $data['banner'] = Url::imgPath().'banner2.png';
        $currentYear = date('Y');
        $listFaculties = $this->faculties->getFacultiesByYear($currentYear);
        $data['listFaculties'] = $listFaculties;
        View::renderTemplate('header', $data,'Home');
        View::render('Home/CreateEntry', $data);
        View::renderTemplate('footer', $data,'Home');
    }

    public function profile(){
        if(Session::get('student') == null){
            Url::redirect('home');
        }
        $faculty = $this->faculties->getFacultyByCode($code);
        $data['title'] = 'View Profile';
        $data['lead'] = "View Profile";
        $data['heading'] = "You can view your profile";
        $data['slogan'] = "View your Profile ...";
        $data['banner'] = Url::imgPath().'banner2.png';
        $currentYear = date('Y');
        $listFaculties = $this->faculties->getFacultiesByYear($currentYear);
        $data['listFaculties'] = $listFaculties;
        $currentFaculty = $this->faculties->get(Session::get('student')[0]->faculty);
        $data['facultyCode'] = $currentFaculty[0]->code;
        View::renderTemplate('header', $data,'Home');
        View::render('Home/Profile', $data);
        View::renderTemplate('footer', $data,'Home');
    }


}