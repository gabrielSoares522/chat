<?php

namespace Source\models;

use CoffeeCode\DataLayer\DataLayer;
use Source\models\Contato;

/**
 * Class Usuario
 * @package Source\models
 */
class Usuario extends DataLayer
{
    /**
     * Usuario constructor.
     */
    public function __construct()
    {
        parent::__construct("usuario", ["nm_login", "nm_email","nm_senha","nm_foto","fotoPerfil"],"id",false);
    }
    
    public function add($login,$email,$senha,$nm_foto,$fotoPerfil)
    {
        $novo = new Usuario();
        $novo->nm_login = $login;
        $novo->nm_email = $email;
        $novo->nm_senha = md5($senha);
        $novo->nm_foto = $nm_foto;
        $novo->fotoPerfil = $fotoPerfil;
        $resultado = $novo->save();
        return $resultado;
    }

    public function getUsuario($login)
    {   
        return null;
        /*$usuario = (new Usuario())->find("nm_login = '".$login."'")->fetch(true);
        if(empty($usuario) == true){
            return null;
        }else{
            return $usuario[0];
        }*/
    }

    public function getId($login)
    {
        $usuario = (new Usuario())->find("nm_login = '".$login."'")->fetch(true);
        return $usuario[0]->id;
    }
    
    public function getContatos()
    {
        return (new Contato())->find("id_usuario = {$this->id}")->fetch(true);
    }

    public function temContato($loginContato)
    {
        $contatos = $this->getContatos();
        foreach($contatos as $contato){
            if($contato->nm_contato == $loginContato){
                return true;
            }
        }
        return false;
    }

    public function loginExiste($login)
    {
        $usuario = (new Usuario())->find("nm_login = :login","login=".$login)->fetch();
        
        return !empty($usuario);
    }

    public function emailExiste($email)
    {
        $usuario = (new Usuario())->find("nm_email = :email","email=".$email)->fetch();
        
        return !empty($usuario);
    }
}