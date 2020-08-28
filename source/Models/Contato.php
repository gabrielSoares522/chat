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
        $idUsuario = (new Usuario())->getId($usuario);
        $idContato = (new Usuario())->getId($contato);
        
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

    public function getContato(int $idUsuario,int $idConversa)
    {
        $contato = (new Contato())->find("id_usuario = :idu AND id_conversa = :idc","idu={$idUsuario}&idc={$idConversa}")->fetch(true);
        return $contato[0];
    }

    public function visualizar(int $idUsuario,int $idConversa)
    {
        $contato = (new Contato())->getContato($idUsuario,$idConversa);
        $data=date("Y-m-d H:i:s");

        $contato->dt_visualizacao = $data;
        $contato->save();

        return $data;
    }
}