<?php
namespace App\Controllers;
use App\Model\{Job,Project};

class indexController{
    public function indexAction(){
        echo 'index Action';
        $jobs = Job::all();
        $project1 = new Project (['Project 1', 'Description 1']);
        $projects =[
        $project1
        ];

            $name = 'Juan Francisco Enrique Aleman Ortega';
            $limitMonths = 2000;
            include '../views/index.php';
    }
}