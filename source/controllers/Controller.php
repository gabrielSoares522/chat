<?php
namespace Source\controllers;

use League\Plates\Engine;

class Controller
{
    public $view;

    public function __construct($router){
        $this->view = Engine::create(dirname(__DIR__,2)."/views","php");
        $this->view->addData(["router"=>$router]);
    }

    public function chat():void
    {
        echo $this->view->render("chat",[]);
    }

    public function login():void
    {
        echo $this->view->render("login",[]);
    }
    public function cadastro():void
    {
        echo $this->view->render("cadastro",[]);
    }
}