<?php

namespace App\Repositories\Contracts\Transaction;

interface TransactionRepositoryInterface
{
    public function all($search, $sortColumn, $sortDirection);
    public function create($data);
    public function find($id);
    public function update($data, $id);
    public function destroy($id);
    public function trash($id);
    public function trashed($search, $sortColumn, $sortDirection);
    public function restore($id);
}