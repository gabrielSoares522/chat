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
}