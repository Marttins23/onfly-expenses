<?php

namespace App\Services\Expense;

use App\Repositories\Expense\ExpenseRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Mockery\MockInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\ExpenseResource;

/**
 * Servico responsavel acionar o repositorio das 'Expenses' e formatar os dados
 * para retorna-los.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Services
 * @subpackage Expense
 * @since Integrado desde 07/10/2024
 */
class EloquentExpenseApiService implements ExpenseServiceInterface
{
    protected ExpenseRepositoryInterface|MockInterface $expenseRepository;

    public function __construct(ExpenseRepositoryInterface|MockInterface $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    /**
     * Retorna todos os registros da tabela 'Expenses' em formato JSON.
     *
     * @return AnonymousResourceCollection
     */
    public function all()
    {
        return ExpenseResource::collection($this->expenseRepository->all());
    }

    /**
     * Cria um objeto da Model 'Expense' e persiste o registro na tabela 'Expenses',
     * dadas as informacoes passadas.
     *
     * @param array $data
     * @return ExpenseResource
     */
    public function create(array $data)
    {
        return new ExpenseResource($this->expenseRepository->create($data));
    }

    /**
     * Atualiza um registro da tabela 'Expenses', tendo como base o identificador
     * do registro e as informacoes passadas.
     *
     * @param  array  $data
     * @param  string|int $id
     * @return ExpenseResource
     */
    public function update(array $data, $id)
    {
        return new ExpenseResource($this->expenseRepository->update($data, $id));
    }

    /**
     * Retorna um determinado registro da tabela 'Expenses', tendo como parametro
     * o identificador do registro.
     *
     * @param  string|int $id
     * @return ExpenseResource
     */
    public function find($id)
    {
        return new ExpenseResource($this->expenseRepository->find($id));
    }

    /**
     * Retorna todos os registros da tabela 'Expenses' associados a um
     * determinado usuario, tendo como parametro o identificador do usuario.
     *
     * @param  string|int $userId
     * @return AnonymousResourceCollection
     */
    public function findAllByUser($userId)
    {
        return ExpenseResource::collection($this->expenseRepository->findAllByUser($userId));
    }

    /**
     * Apaga um determinado registro da tabela 'Expenses', tendo como base o
     * identificador do registro passado como parametro.
     *
     * @param  string $id
     * @return bool|null|JsonResponse
     */
    public function delete($id)
    {
        return response()->json($this->expenseRepository->delete($id), 204);
    }
}
