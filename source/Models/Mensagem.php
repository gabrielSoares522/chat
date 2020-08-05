<?php

namespace Source\models;

use CoffeeCode\DataLayer\DataLayer;

/**
 * Class Mensagem
 * @package Source\models
 */
class Mensagem extends DataLayer
{
    /**
     * Mensagem constructor.
     */
    public function __construct()
    {
        parent::__construct("mensagem", ["id_conversa", "id_usuario","dt_envio","ds_mensagem"],"id",false);
    }

    public function getMensagens($idConversa,$visualizacao)
    {
        $mensagens = (new Mensagem())->find("id_conversa = {$idConversa} AND dt_envio >'{$visualizacao}'")->fetch(true);
        return $mensagens;
    }

    public function add($idUsuario,$idConversa,$texto)
    {
        $mensagem = new Mensagem();
        $dtEnvio = date('Y-m-d H:i:s');

        $mensagem->id_conversa = $idConversa;
        $mensagem->id_usuario = $idUsuario;
        $mensagem->dt_envio = $dtEnvio;
        $mensagem->ds_mensagem = $texto;
        $mensagem->save();
    }
}