<?php
namespace Source\controllers;

use Source\models\Usuario;
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

    public function criarConta(array $data):void
    {
        $dados =filter_var_array($data,FILTER_SANITAZE_STRING);
        
        if(in_array("",$dados)){
            $callback["message"] = message("Preencha todos os campos!","error");
            echo json_encode();
            return;
        }

        $usuario = new Usuario();
        $usuario->nm_login = $dados["txtLogin"];
        $usuario->nm_email = $dados["txtEmail"];
        $usuario->nm_senha = $dados["txtSenha"];
        $usuario->ft_perfil = $dados["fotoPerfil"];

        $usuario->save();

        $callback["message"] = message("Conta criada!","success");

        echo json_encode($callback);
    }

    public function criarContato(array $data):void
    {

    }

    public function enviarMensagem(array $data):void
    {
        
    }

    public function buscarConversa(array $data):void
    {
        
    }

    public function atualizarMensagem(array $data):void
    {

    }
}