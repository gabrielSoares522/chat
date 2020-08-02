<?php

namespace Source\models;

use CoffeeCode\DataLayer\DataLayer;

/**
 * Class Conversa
 * @package Source\models
 */
class Conversa extends DataLayer
{
    /**
     * Conversa constructor.
     */
    public function __construct()
    {
        parent::__construct("conversa", ["dt_criacao"],"id",false);
    }

    public function add()
    {
        $conversa = new conversa();
        $dt_criacao = date('Y-m-d H:i:s');

        $conversa->dt_criacao = $dt_criacao;
        $conversa->save();
        return $conversa->id;
    }
}