<?php

namespace App\Repositories\Expense;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Collection;

/**
 * Repository da Model 'Expense'. Encapsula toda a logica de persistencia de
 * objetos dessa classe.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Repositories
 * @subpackage Expense
 * @since Integrado desde 07/10/2024
 */
class EloquentExpenseRepository implements ExpenseRepositoryInterface
{
    /**
     * Retorna todos os registros da tabela 'Expenses'.
     *
     * @return Collection|Expense[]
     */
    public function all()
    {
        return Expense::all();
    }

    /**
     * Cria um objeto da Model 'Expense' e persiste o registro na tabela 'Expenses',
     * dadas as informacoes passadas como parametro.
     *
     * @param  array $data
     * @return Expense
     */
    public function create(array $data)
    {
        return Expense::create($data);
    }

    /**
     * Atualiza um registro da tabela 'Expenses', tendo como base o identificador
     * do registro e as informacoes passadas como parametro.
     *
     * @param  array  $data
     * @param  string|int $id
     * @return Expense
     */
    public function update(array $data, $id)
    {
        $expense = $this->findExpenseOrFail($id);
        $expense->update($data);

        return $expense;
    }

    /**
     * Deleta um registro da tabela 'Expenses', tendo como parametro o identificador
     * do registro. Retorna 'true' em caso de succeso, ou 'false' em caso
     * de falha.
     *
     * @param  string|int $id
     * @return void
     */
    public function delete($id)
    {
        $expense = $this->findExpenseOrFail($id);
        $expense->delete();
    }

    /**
     * Encontra e retorna um registro da tabela 'Expenses', tendo como parametro
     * o identificador do registro.
     *
     * @param  string|int $id
     * @return Expense
     */
    public function find($id)
    {
        return $this->findExpenseOrFail($id);
    }

    /**
     * Encontra e retorna um registro da tabela 'Expenses', tendo como parametro
     * o identificador do usuario.
     *
     * @param  string|int $userId
     * @return Collection|Expense[]
     */
    public function findAllByUser($userId)
    {
        return Expense::where('user_id', $userId)->get();
    }

    /**
     * Encontra e retorna um registro da tabela 'Expenses', tendo como parametro
     * o identificador do registro, ou lanca um  execao, em caso de falha.
     *
     * @param  string|int $id
     * @return Expense
     */
    private function findExpenseOrFail($id): Expense
    {
        return Expense::findOrFail($id);
    }

}
