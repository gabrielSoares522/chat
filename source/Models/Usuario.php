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
        /*$conn = new mysqli("localhost", "root", "1234","chat");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
          return false;
        }
        $sql = "INSERT INTO usuario (id, nm_login, nm_email,nm_senha,nm_foto,fotoPerfil) VALUES (2,'$login', '$email', '"+md5($senha)+"','$nm_foto','$fotoPerfil')";

        if ($conn->query($sql) === TRUE) {
            $conn->close();
            return true;
          } else {
            $conn->close();
            return false;
          }*/
        $novo = new Usuario();
        $novo->nm_login = $login;
        $novo->nm_email = $email;
        $novo->nm_senha = md5($senha);
        $novo->nm_foto = $nm_foto;
        $novo->fotoPerfil = $fotoPerfil;
        return $novo->save();
    }

    public function getUsuario(string $login)
    {
        $usuario = (new Usuario())->find("nm_login = '".$login."'")->fetch(true);
        return $usuario[0];
    }

    public function getId(string $login)
    {
        $usuario = (new Usuario())->find("nm_login = '".$login."'")->fetch(true);
        return $usuario[0]->id;
    }
    
    public function getContatos()
    {
        return (new Contato())->find("id_usuario = :uid","uid={$this->id}")->fetch(true);
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

    public function loginExiste(string $login)
    {
        $usuario = (new Usuario())->find("nm_login = '".$login."'")->fetch(true);
        if(empty($usuario)){
            return false;
        }else{
            return true;
        }
    }

    public function emailExiste(string $email)
    {
        $usuario = (new Usuario())->find("nm_email = '".$email."'")->fetch(true);
        if(empty($usuario)){
            return false;
        }else{
            return true;
        }
    }
}