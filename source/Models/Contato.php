<?php

namespace Source\models;

use CoffeeCode\DataLayer\DataLayer;

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
    parent::__construct("contatos", ["nm_contato", "dt_visualizacao"],["id_usuario","id_conversa"],false);
    }
}