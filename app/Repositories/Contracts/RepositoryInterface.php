<?php


namespace App\Repositories\Contracts;


use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function all(array $columns = ['*'], array $relations = []);

    public function find(int $id, array $columns = ['*']);

    public function findWhere(array $conditions, array $columns = ['*']);

    public function store(array $item);

    public function update(int $ID, array $item);

    public function delete(int $ID);

    public function exists(array $conditions): bool;
}
