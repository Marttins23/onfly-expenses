<?php

namespace App\Services\User;

/**
 * Interface que define os metodos obrigatorios dos 'UserService'.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Services
 * @subpackage User
 * @since Integrado desde 06/10/2024
 */
interface UserServiceInterface
{
    public function create(array $data);
}
