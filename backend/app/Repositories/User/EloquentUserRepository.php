<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Repository da Model 'User'. Encapsula toda a logica de persistencia de
 * objetos dessa classe.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Repositories
 * @subpackage User
 * @since Integrado desde 07/10/2024
 */
class EloquentUserRepository implements UserRepositoryInterface
{
    /**
     * Cria um objeto da Model 'User' e persiste o registro na tabela 'Users',
     * dadas as informacoes passadas como parametro.
     *
     * @param  array $data
     * @return User
     */
    public function create(array $data)
    {
        return User::create($data);
    }
}
