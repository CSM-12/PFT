<?php

namespace App\Repositories\Contracts\Transaction;

interface TransactionRepositoryInterface
{
    public function all();
    public function create($data);
    public function find($id);
    public function update($data, $id);
    public function destroy($id);
    public function trash($id);
    public function trashed();
    public function restore($id);
}