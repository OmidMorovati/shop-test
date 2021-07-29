<?php


namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\EloquentBaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository extends EloquentBaseRepository implements UserRepositoryInterface
{
    protected function model(): string
    {
        return User::class;
    }

    public function update(int $id, array $items): Model
    {
        /** @var User $model */
        $model = $this->find($id);
        if ($model) {
            if (isset($items['lat'], $items['lng'])) {
                $model->location = new Point($items['lat'], $items['lng']);
                unset($items['lat'],$items['lng']);
            }
            $model->update($items);
            return $model;
        }
        throw new ModelNotFoundException('model not found!');
    }

    public function store(array $item): Model
    {
        return $this->model::updateOrCreate($item);
    }
}
