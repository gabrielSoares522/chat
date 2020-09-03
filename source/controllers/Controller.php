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
            $usuario = (new Usuario())->getUsuario($login);
            echo $this->view->render("chat",["contatos"=>$usuario->getContatos(),"foto"=>$usuario->fotoPerfil]);
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

    public function redefineSenha():void
    {
        echo $this->view->render("redefineSenha",[]);
    }

    public function criarConta(array $data):void
    {
        $usuario = new Usuario();
        $dados = filter_var_array($data,FILTER_SANITIZE_STRING);
            
        if(in_array("",$dados)){
            $callback["erro"] = "Preencha todos os campos!";
            echo json_encode($callback);
            return;
        }

        $login = $dados["txtLogin"];
        $email = $dados["txtEmail"];
        $senha = $dados["txtSenha"];
        //$nmFoto = $dados['fotoNome'];
        //$foto = $dados['fotoPerfil'];
        $nmFoto = $_FILES['fotoPerfil']["name"];
        $foto = $_FILES['fotoPerfil']['tmp_name'];
        $foto = addslashes(file_get_contents($foto));

        if($usuario->loginExiste($login)){
            $callback["erro"] = "login já utilizado!";
            echo json_encode($callback);
            return;
        }

        if($usuario->emailExiste($email)){
            $callback["erro"] = "email já utilizado!";
            echo json_encode($callback);
            return;
        }

        $usuario->add($login,$email,$senha,$nmFoto,$foto);
        
        $callback["cadastrado"] = "Usuario cadastrado com sucesso!";
        echo json_encode($callback);
    }

    public function entrar(array $data):void
    {
        $data = filter_var_array($data,FILTER_SANITIZE_STRING);
        $entrou = true;
        
        $usuario = (new Usuario())->getUsuario($data["txtLogin"]);

        if(empty($usuario)){
            $entrou=false;
        }
        else{
            if(md5($data["txtSenha"]) != $usuario->nm_senha){
                $entrou=false;
            }
        }
        echo $this->view->render("entrar",["entrou" => $entrou, "login"=>$data["txtLogin"]]);
    }

    public function addContato(array $data):void
    {
        $data = filter_var_array($data,FILTER_SANITIZE_STRING);
        $loginUsuario =$data["hdLogin"];
        $loginContato =$data["txtAddContato"];

        $usuario = (new Usuario())->getUsuario($loginContato);
        if(empty($usuario)){
            $callback["menssagem"] = message("login invalidado!","error");
            echo json_encode($callback);
            return;
        }

        $usuario = (new Usuario())->getUsuario($loginUsuario);
        if($usuario->temContato($loginContato)==false){
            $contato = new Contato();
            $dadosContato = $contato->add($loginUsuario,$loginContato);
            $callback["mensagem"] = message("Contato cadastrado!","success");
            $callback["contato"] = $this->view->render("contato",$dadosContato);
        }
        else{
            $callback["mensagem"] = message("Ja existe o contato!","error");
        }
        echo json_encode($callback);
    }

    public function enviarMsg(array $data):void
    {
        $data = filter_var_array($data,FILTER_SANITIZE_STRING);
        
        $idUsuario = (new Usuario())->getId($data["hdLoginMsg"]);

        $mensagem = new Mensagem();

        $mensagem->add($idUsuario,$data["hdConversa"],$data["txtMsg"]);

        $contato = (new Contato())->visualizar($idUsuario,$data["hdConversa"]);

        $callback["enviada"] = $this->view->render("mensagem",["tipo"=>"enviada","texto"=>$data["txtMsg"]]);
        echo json_encode($callback);
    }

    public function buscarConversa(array $data):void
    {
        $data = filter_var_array($data,FILTER_SANITIZE_STRING);
        $idUsuario = (new Usuario())->getId($data["hdLoginCov"]);

        $mensagens = (new Mensagem())->find("id_conversa=".$data["hdNovaCov"])->fetch(true);
        
        (new Contato())->visualizar($idUsuario,$data["hdNovaCov"]);
        $callback["conversa"]="";
        if(!empty($mensagens)){
            foreach($mensagens as $mensagem){
                if($mensagem->id_usuario == $idUsuario) { $tipo="enviada"; }
                else { $tipo="recebida"; }

                $novaMsg=$this->view->render("mensagem",["tipo"=>$tipo,"texto"=>$mensagem->ds_mensagem]);
                $callback["conversa"] = $callback["conversa"].$novaMsg;
            }
            echo json_encode($callback);
        }
    }

    public function atualizarMensagem(array $data):void
    {
        $data = filter_var_array($data,FILTER_SANITIZE_STRING);
        $idUsuario = (new Usuario())->getId($data["login"]);
        $idConversa = $data["idConversa"];

        $visualizacao = (new Contato())->getContato($idUsuario,$idConversa)->dt_visualizacao;
        $mensagens = (new Mensagem())->getMensagens($idConversa,$visualizacao);

        if(!empty($mensagens)){
            foreach($mensagens as $mensagem){
                if($mensagem->id_usuario == $idUsuario) { $tipo="enviada"; }
                else { $tipo="recebida"; }

                $msg = $this->view->render("mensagem",["tipo"=>$tipo,"texto"=>$mensagem->ds_mensagem]);
                if(isset($data["resposta"])){$data["resposta"] =  $data["resposta"].$msg;}
                else{$data["resposta"] = $msg;}
            }
            (new Contato())->visualizar($idUsuario,$idConversa);
            echo json_encode($data);
        }

    }
}