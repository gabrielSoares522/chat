<?php

namespace Source\models;

use CoffeeCode\DataLayer\DataLayer;
use Source\models\Conversa;

/**
 * Class Contato
 * @package Source\models
 */
class Contato extends DataLayer
{
    /**
     * Contato constructor.
     */
    public function __construct()
    {
        parent::__construct("contatos", ["id_usuario","id_conversa","nm_contato", "dt_visualizacao"],"id",false);
    }

    public function add(string $usuario,string $contato)
    {
        $conversa = new Conversa();

        $idConversa = $conversa->add();
        $idUsuario = (new Usuario())->getUsuario($usuario)->id;
        $idContato = (new Usuario())->getUsuario($contato)->id;
        
        $contato1 = new Contato();
        $contato1->id_usuario = $idUsuario;
        $contato1->id_conversa = $idConversa;
        $contato1->nm_contato = $contato;
        $contato1->dt_visualizacao = date("Y-m-d H:i:s");
        $contato1->save();

        $contato2 = new Contato();
        $contato2->id_usuario = $idContato;
        $contato2->id_conversa = $idConversa;
        $contato2->nm_contato = $usuario;
        $contato2->dt_visualizacao = date("Y-m-d H:i:s");
        $contato2->save();

        return ["nome"=>$contato,"conversa"=>$idConversa];
    }
}