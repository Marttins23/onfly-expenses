<?php

namespace App\Services\User;

use App\Http\Resources\UserResource;
use App\Repositories\User\UserRepositoryInterface;
use Mockery\MockInterface;

/**
 * Servico responsavel acionar o repositorio das 'Users' e validar o retorno
 * das operacoes.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Services
 * @subpackage User
 * @since Integrado desde 01/09/2024
 */
class EloquentUserApiService implements UserServiceInterface
{
    protected UserRepositoryInterface|MockInterface $userRepository;

    public function __construct(UserRepositoryInterface|MockInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Cria um objeto da Model 'User' e persiste o registro na tabela 'Users',
     * dadas as informacoes passadas.
     *
     * @param  array $data
     * @return UserResource
     */
    public function create(array $data)
    {
        return new UserResource($this->userRepository->create($data));
    }
}
