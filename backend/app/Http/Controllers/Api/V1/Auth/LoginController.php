<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Controller responsavel pela logica de autenticacao (login).
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Http\Controllers
 * @subpackage API\V1\Auth
 * @version 1.0.0 Versao em producao
 * @since Integrado desde 08/10/2024
 */
class LoginController extends Controller
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
     * Valida os dados fornecidos no login e retorna o token para que o usuario
     * possa se autenticar, em caso de sucesso.
     *
     * @param  LoginRequest $request
     * @return LoginResource
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->safe()->all()) === false) {
            return response()->json('Unauthorized', 401);
        }

        $user = Auth::user();
        $token = $this->getUserToken(Auth::user());

        return new LoginResource($token, new UserResource($user));
    }

    /**
     * Deleta o token de autenticacao antigo, gera e retorna um novo token.
     *
     * @param  Authenticatable|User $user
     * @return string
     */
    private function getUserToken(Authenticatable|User $user)
    {
        $user->tokens()->delete();

        return $user->createToken('client-user-token')->plainTextToken;
    }
}
