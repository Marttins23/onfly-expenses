<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Expense\UpdateExpenseRequest;

class UpdateExpenseRequestTest extends TestCase
{
    protected function getValidatorInstance(array $data)
    {
        $request = new UpdateExpenseRequest();

        return Validator::make($data, $request->rules(), $request->messages(), $request->attributes());
    }

    public function test_valid_data_passes_validation()
    {
        $user = User::factory()->create();

        $data = [
            'description' => 'Compra válida',
            'value' => 100.0,
            'date' => '2024-10-01',
            'user_id' => $user->id
        ];

        $validator = $this->getValidatorInstance($data);
        
        $this->assertTrue($validator->passes());
    }

    public function test_invalid_description_fails_validation()
    {
        $data = [
            'description' => 'AB',
            'value' => 100.0,
            'date' => '2024-10-01',
            'user_id' => 1
        ];

        $validator = $this->getValidatorInstance($data);

        $this->assertFalse($validator->passes());
        $this->assertEquals("O campo 'descricao' deve conter pelo menos 3 caracteres", $validator->errors()->first('description'));
    }

    public function test_invalid_value_fails_validation()
    {
        $data = [
            'description' => 'Compra válida',
            'value' => 'invalid',
            'date' => '2024-10-01',
            'user_id' => 1
        ];

        $validator = $this->getValidatorInstance($data);

        $this->assertFalse($validator->passes());
        $this->assertEquals("O campo 'valor' deve ser um número.", $validator->errors()->first('value'));
    }

    public function test_invalid_date_fails_validation()
    {
        $data = [
            'description' => 'Compra válida',
            'value' => 100.0,
            'date' => '2024-10-10',
            'user_id' => 1
        ];

        $validator = $this->getValidatorInstance($data);

        $this->assertFalse($validator->passes());
        $this->assertEquals("A data máxima permitida é a data atual.", $validator->errors()->first('date'));
    }

    public function test_invalid_user_id_fails_validation()
    {
        $data = [
            'description' => 'Compra válida',
            'value' => 100.0,
            'date' => '2024-10-01',
            'user_id' => 999
        ];

        $validator = $this->getValidatorInstance($data);

        $this->assertFalse($validator->passes());
        $this->assertEquals("Não existe nenhum usuário com o ID informado.", $validator->errors()->first('user_id'));
    }

}
