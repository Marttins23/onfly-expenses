<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * API Resource que encapsula o token e os dados do usuario autenticado.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App
 * @subpackage Resources
 * @version 1.0.0 Versao em producao
 * @since Integrado desde 08/10/2024
 */
class LoginResource extends JsonResource
{
    protected $token;
    protected $user;

    public function __construct(string $token, UserResource $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    /**
     * Transforma o resource em array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->token,
            'user' => $this->user
        ];
    }
}
