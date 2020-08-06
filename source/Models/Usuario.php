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
        parent::__construct("Usuario", ["nm_login", "nm_email","nm_senha","ft_perfil"],"id",false);
    }
    
    public function add($login,$email,$senha,$fotoPerfil)
    {
        $usuario = new Usuario();
        $usuario->nm_login = $login;
        $usuario->nm_email = $email;
        $usuario->nm_senha = md5($senha);
        $usuario->ft_perfil = $fotoPerfil;
    
        $usuario->save();
        return $usuario;
    }

    public function getUsuario(string $login)
    {
        $usuario = (new Usuario())->find("nm_login = '".$login."'")->fetch(true);
        return $usuario[0];
    }

    public function getId(string $login){
        $usuario = (new Usuario())->find("nm_login = '".$login."'")->fetch(true);
        return $usuario[0]->id;
    }
    
    public function getContatos()
    {
        return (new Contato())->find("id_usuario = :uid","uid={$this->id}")->fetch(true);
    }
}