<?php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;

/**
 * Policy responsavel pelo controle de acesso da Model 'Expense'.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App
 * @subpackage Policies
 * @version 1.0.0 Versao em producao
 * @since Integrado desde 08/10/2024
 */
class ExpensePolicy
{
    /**
     * Determina quando o usuario pode ver a model.
     */
    public function view(User $user, Expense $expense): bool
    {
        return $expense->user_id === $user->id;
    }

    /**
     * Determina quando o usuario pode atualizar a model.
     */
    public function update(User $user, Expense $expense): bool
    {
        return $expense->user_id === $user->id;
    }

    /**
     * Determina quando o usuario pode deletar a model.
     */
    public function delete(User $user, Expense $expense): bool
    {
        return $expense->user_id === $user->id;
    }
}
