<?php


namespace App\Repositories\Eloquent;

use App\Models\Store;
use App\Repositories\Contracts\EloquentBaseRepository;
use App\Repositories\Contracts\StoreRepositoryInterface;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StoreRepository extends EloquentBaseRepository implements StoreRepositoryInterface
{
    protected function model(): string
    {
        return Store::class;
    }

    public function update(int $id, array $item): Model
    {
        /** @var Store $model */
        $model = $this->find($id);
        if ($model) {
            if (isset($item['lat'], $item['lng'])) {
                $item['location'] = new Point($item['lat'], $item['lng']);
                unset($item['lat'],$item['lng']);
            }
            $model->update($item);
            return $model;
        }
        throw new ModelNotFoundException('model not found!');
    }

    public function store(array $item): Model
    {
        return $this->model::updateOrCreate($item);
    }
}
