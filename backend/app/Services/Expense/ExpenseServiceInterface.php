<?php

namespace App\Services\Expense;

/**
 * Interface que define os metodos obrigatorios dos 'ExpenseService'.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Services
 * @subpackage Expense
 * @since Integrado desde 06/10/2024
 */
interface ExpenseServiceInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function findAllByUser($userId);
}
