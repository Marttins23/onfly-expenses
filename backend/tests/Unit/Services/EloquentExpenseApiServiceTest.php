<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use Mockery;
use App\Services\Expense\EloquentExpenseApiService;
use App\Repositories\Expense\ExpenseRepositoryInterface;
use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EloquentExpenseApiServiceTest extends TestCase
{
    protected $expenseRepositoryMock;
    protected $expenseService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->expenseRepositoryMock = Mockery::mock(ExpenseRepositoryInterface::class);

        $this->expenseService = new EloquentExpenseApiService($this->expenseRepositoryMock);
    }

    public function test_all_returns_all_expenses()
    {
        $expenses = collect([
            ['id' => 1, 'description' => 'Compra 1', 'value' => 100.0],
            ['id' => 2, 'description' => 'Compra 2', 'value' => 200.0]
        ]);

        $this->expenseRepositoryMock->shouldReceive('all')->once()->andReturn($expenses);

        $result = $this->expenseService->all();

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }

    public function test_create_creates_and_returns_new_expense()
    {
        $data = ['description' => 'Compra', 'value' => 150.0];

        $createdExpense = (object) ['id' => 1, 'description' => 'Compra', 'value' => 150.0];

        $this->expenseRepositoryMock->shouldReceive('create')->once()->with($data)->andReturn($createdExpense);

        $result = $this->expenseService->create($data);

        $this->assertInstanceOf(ExpenseResource::class, $result);
        $this->assertEquals($createdExpense->id, $result->id);
    }

    public function test_update_updates_expense_and_returns_it()
    {
        $data = ['description' => 'Compra Atualizada', 'value' => 175.0];
        $expenseId = 1;

        $updatedExpense = (object) ['id' => $expenseId, 'description' => 'Compra Atualizada', 'value' => 175.0];

        $this->expenseRepositoryMock->shouldReceive('update')->once()->with($data, $expenseId)->andReturn($updatedExpense);

        $result = $this->expenseService->update($data, $expenseId);

        $this->assertInstanceOf(ExpenseResource::class, $result);
        $this->assertEquals($updatedExpense->id, $result->id);
    }

    public function test_find_returns_single_expense()
    {
        $expenseId = 1;

        $expense = (object) ['id' => $expenseId, 'description' => 'Compra', 'value' => 150.0];

        $this->expenseRepositoryMock->shouldReceive('find')->once()->with($expenseId)->andReturn($expense);

        $result = $this->expenseService->find($expenseId);

        $this->assertInstanceOf(ExpenseResource::class, $result);
        $this->assertEquals($expense->id, $result->id);
    }

    public function test_find_all_by_user_returns_expenses_for_user()
    {
        $userId = 1;

        $expenses = collect([
            ['id' => 1, 'description' => 'Compra 1', 'value' => 100.0],
            ['id' => 2, 'description' => 'Compra 2', 'value' => 200.0]
        ]);

        $this->expenseRepositoryMock->shouldReceive('findAllByUser')->once()->with($userId)->andReturn($expenses);

        $result = $this->expenseService->findAllByUser($userId);

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }

    public function test_delete_deletes_expense_and_returns_true()
    {
        $expenseId = 1;

        $this->expenseRepositoryMock->shouldReceive('delete')->once()->with($expenseId)->andReturn(true);

        $response = $this->expenseService->delete($expenseId);

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertTrue($response->getData());
    }
}
