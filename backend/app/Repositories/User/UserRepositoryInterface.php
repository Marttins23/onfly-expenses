<?php

namespace App\Repositories\User;

/**
 * Interface que define os metodos obrigatorios dos 'UserRepository'.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Repositories
 * @subpackage User
 * @since Integrado desde 07/10/2024
 */
interface UserRepositoryInterface
{
    public function create(array $data);
}
