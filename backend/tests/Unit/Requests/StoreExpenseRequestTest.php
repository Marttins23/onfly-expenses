<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\Expense\StoreExpenseRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Tests\TestCase;

class StoreExpenseRequestTest extends TestCase
{
    protected function createValidator(array $data)
    {
        $request = new StoreExpenseRequest();

        $rules = $request->rules();
        $messages = $request->messages();
        $attributes = $request->attributes();

        return Validator::make($data, $rules, $messages, $attributes);
    }

    public function test_valid_expense_data_passes_validation()
    {
        $user = User::factory()->create();

        $data = [
            'description' => 'Compra de material',
            'value' => 150.50,
            'date' => now()->toDateString(),
            'user_id' => $user->id,
        ];

        $validator = $this->createValidator($data);

        $this->assertTrue($validator->passes());
    }

    public function test_invalid_description_fails_validation()
    {
        $data = [
            'description' => 'AB',
            'value' => 150.50,
            'date' => now()->toDateString(),
            'user_id' => 1,
        ];

        $validator = $this->createValidator($data);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('description', $validator->errors()->messages());
    }

    public function test_invalid_value_fails_validation()
    {
        $data = [
            'description' => 'Compra de material',
            'value' => 'invalid',
            'date' => now()->toDateString(),
            'user_id' => 1,
        ];

        $validator = $this->createValidator($data);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('value', $validator->errors()->messages());
    }

    public function test_invalid_date_fails_validation()
    {
        $data = [
            'description' => 'Compra de material',
            'value' => 150.50,
            'date' => '2050-12-01',
            'user_id' => 1,
        ];

        $validator = $this->createValidator($data);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('date', $validator->errors()->messages());
    }

    public function test_invalid_user_id_fails_validation()
    {
        $data = [
            'description' => 'Compra de material',
            'value' => 150.50,
            'date' => now()->toDateString(),
            'user_id' => 9999,
        ];

        $validator = $this->createValidator($data);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('user_id', $validator->errors()->messages());
    }
}
