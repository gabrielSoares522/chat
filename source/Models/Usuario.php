<?php

namespace Source\models;

use CoffeeCode\DataLayer\DataLayer;

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
}