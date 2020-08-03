<?php
namespace Source\controllers;

use Source\models\Usuario;
use Source\models\Contato;
use Source\models\Conversa;
use Source\models\Mensagem;
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
        session_start();
        $login = $_SESSION["login"];
        if(isset($_SESSION["login"])){
            $usuario = (new Usuario())->find("nm_login = '".$login."'")->fetch(true);
            echo $this->view->render("chat",["contatos"=>$usuario[0]->getContatos()]);
        }
        else{
            echo $this->view->render("chat",[]);
        }
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
        $dados = filter_var_array($data,FILTER_SANITIZE_STRING);
            
        if(in_array("",$dados)){
            $callback["message"] = message("Preencha todos os campos!","error");
            echo json_encode($callback);
            return;
        }
    
        $usuario = new Usuario();
        $usuario->nm_login = $dados["txtLogin"];
        $usuario->nm_email = $dados["txtEmail"];
        $usuario->nm_senha = md5($dados["txtSenha"]);
        $usuario->ft_perfil = $dados["fotoPerfil"];
    
        $usuario->save();
        
        echo $this->view->render("criarConta",[]);
    }

    public function entrar(array $data):void
    {
        $data = filter_var_array($data,FILTER_SANITIZE_STRING);
        $entrou = true;
        
        $usuario = (new Usuario())->find("nm_login = '".$data["txtLogin"]."'")->fetch(true);
        if(empty($usuario)){
            $entrou=false;
        }
        else{
            if(md5($data["txtSenha"]) != $usuario[0]->nm_senha){
                $entrou=false;
            }
        }
        echo $this->view->render("entrar",["entrou" => $entrou, "login"=>$data["txtLogin"]]);
    }

    public function sair():void
    {
        echo $this->view->render("sair",[]);
    }

    public function addContato(array $data):void
    {
        $data = filter_var_array($data,FILTER_SANITIZE_STRING);
        $usuario = (new Usuario())->find("nm_login = '".$data["txtAddContato"]."'")->fetch(true);

        if(empty($usuario)){
            $callback["menssagem"] = message("login invalidado!","error");
            echo json_encode($callback);
            return;
        }

        $contato = new Contato();
        $dadosContato = $contato->add($data["hdLogin"],$data["txtAddContato"]);
        $callback["menssagem"] = message("Contato cadastrado!","success");
        $callback["contato"] = $this->view->render("contato",$dadosContato);

        echo json_encode($callback);
    }

    public function enviarMsg(array $data):void
    {
        $data = filter_var_array($data,FILTER_SANITIZE_STRING);

        
        $conversa = $data["hdConversa"];
        $mensgagem = $data["txtMsg"];
        $usuario = (new Usuario())->find("nm_login = '".$data["hdLoginMsg"]."'")->fetch(true);

        $idUsuario = $usuario[0]->id;

        $mensagem = new Mensagem();

        $mensagem->add($idUsuario,$data["hdConversa"],$data["txtMsg"]);

        $callback["enviada"] = $this->view->render("mensagem",["tipo"=>"enviada","texto"=>$data["txtMsg"]]);
        echo json_encode($callback);
    }

    public function buscarConversa(array $data):void
    {
        
    }

    public function atualizarMensagem(array $data):void
    {

    }
}