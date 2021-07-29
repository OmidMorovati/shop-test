<?php


namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Prophecy\Exception\Doubler\ClassNotFoundException;

abstract class EloquentBaseRepository implements RepositoryInterface
{
    private $model;

    abstract protected function model(): string;


    public function __construct()
    {
        $this->makeModel();
    }

    public function makeModel()
    {
        $model = App::make($this->model());

        if (!$model instanceof Model) {
            throw new ClassNotFoundException('class not found!', $this->model);
        }
        return $this->model = $model;
    }
    /**
     * Applies the given where conditions to the model.
     *
     * @param array $where
     * @return void
     */
    protected function applyConditions(array $where): void
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                [$field, $condition, $val] = $value;
                $this->model = $this->model->where($field, $condition, $val);
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
    }


    private function applyRelations(array $relations): void
    {
        if (!empty($relations)) {
            $this->model = $this->model->with($relations);
        }
    }

    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        $this->applyRelations($relations);

        return $this->model->get($columns);

    }

    public function find(int $id, $columns = ['*'], array $relations = []): Model
    {
        $this->applyRelations($relations);

        return $this->model->findOrFail($id, $columns);
    }


    public function store(array $item): Model
    {
        return $this->model::create($item);
    }

    public function update(int $id, array $item): Model
    {
        $model = $this->find($id);
        if ($model) {
            $model->update($item);
            return $model;
        }
        throw new ModelNotFoundException('model not found!');
    }

    public function delete(int $id)
    {
        if ($this->find($id)) {
            return $this->model::destroy($id);
        }
        throw new ModelNotFoundException('model not found!');
    }


    public function findWhere(array $conditions, $columns = ['*'], array $relations = []): Model
    {
        $this->applyConditions($conditions);
        $this->applyRelations($relations);

        return $this->model->first($columns);
    }
}
