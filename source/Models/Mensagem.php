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
        parent::__construct("mensagen", ["id_conversa", "id_usuario","dt_envio","ds_mensagem"],"id",false);
    }
}