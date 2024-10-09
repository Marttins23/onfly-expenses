<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Expense\StoreExpenseRequest;
use App\Http\Requests\Expense\UpdateExpenseRequest;
use App\Services\Expense\ExpenseServiceInterface;
use App\Models\Expense;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\ExpenseResource;

/**
 * Controller responsavel pela manipulacao dos dados dos registros
 * da tabela 'expenses'.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Http\Controllers
 * @subpackage API\V1
 * @version 1.0.0 Versao em producao
 * @since Integrado desde 08/10/2024
 */
class ExpenseController extends Controller
{
    /**
     * @var ExpenseServiceInterface
     */
    protected $expenseService;

    public function __construct(ExpenseServiceInterface $expenseService)
    {
        $this->expenseService = $expenseService;
    }

    /**
     * Lista todas as despesas de um determinado usuario
     *
     * @param  string $userId
     * @return AnonymousResourceCollection
     */
    public function index($userId)
    {
        return $this->expenseService->findAllByUser($userId);
    }

    /**
     * Registra uma nova despesa para um determinado usuario.
     *
     * @param  StoreExpenseRequest $request
     * @return ExpenseResource
     */
    public function store(StoreExpenseRequest $request)
    {
        return  $this->expenseService->create($request->safe()->all());
    }

    /**
     * Lista uma determinada despesa, dado o seu ID.
     *
     * @param  Expense $expense
     * @return ExpenseResource
     */
    public function show(Expense $expense)
    {
        $this->authorize('view', $expense);
        return $this->expenseService->find($expense->id);
    }

    /**
     * Atualiza uma determinada despesa.
     *
     * @param  UpdateExpenseRequest $request
     * @param  Expense $expense
     * @return ExpenseResource
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $this->authorize('update', $expense);
        return $this->expenseService->update($request->safe()->all(), $expense->id);
    }

    /**
     * Deleta uma determinada despesa.
     *
     * @param  Expense $expense
     * @return ExpenseResource
     */
    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);
        return $this->expenseService->delete($expense->id);
    }
}
