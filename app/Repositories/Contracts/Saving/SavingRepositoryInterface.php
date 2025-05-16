<?php

namespace App\Repositories\Contracts\Saving;

interface SavingRepositoryInterface
{
    public function all($search, $sortColumn, $sortDirection);
    public function create($data);
    public function find($id);
    public function update($data, $id);
    public function destroy($id);
    public function trash($id);
    public function trashed();
    public function restore($id);
}