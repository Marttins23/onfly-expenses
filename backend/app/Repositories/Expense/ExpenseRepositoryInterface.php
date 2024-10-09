<?php

namespace App\Repositories\Expense;

/**
 * Interface que define os metodos obrigatorios dos 'ExpenseRepository'.
 *
 * @author Mateus Ferreira Martins <mateus_martins18@yahoo.com.br>
 * @package App\Repositories
 * @subpackage Expense
 * @since Integrado desde 07/10/2024
 */
interface ExpenseRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function findAllByUser($userId);
}
