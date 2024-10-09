<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

/**
 * Controller responsavel pela logica de registrar um novo usuario no sistema.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Http\Controllers
 * @subpackage API\V1\Auth
 * @version 1.0.0 Versao em producao
 * @since Integrado desde 08/10/2024
 */
class RegisterController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    
    /**
     * Registra um novo usuario no sistema e retorna os dados do usuario
     * recem cadastrado.
     *
     * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
     * @param  RegisterRequest $request
     * @return UserResource
     */
    public function register(RegisterRequest $request)
    {
        $userData = $this->getUserDataWithHashedPassword($request->safe()->all());

        return $this->userService->create($userData);
    }

    /**
     * Faz o hash da senha do usuario e retorna o array com a senha modificada.
     *
     * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
     * @param  array $userData
     * @return array
     */
    public function getUserDataWithHashedPassword(array $userData)
    {
        $userData['password'] = Hash::make($userData['password']);

        return $userData;
    }
}
