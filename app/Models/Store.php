<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Store
 *
 * Properties:
 *
 * @property int id
 * @property int user_id
 * @property string name
 * @property string location
 * @property string created_at
 * @property string updated_at
 *
 */
class Store extends Model
{
    use HasFactory, SpatialTrait;

    protected $guarded = ['id'];

    protected $spatialFields = ['location'];

    public function owner()
    {
        $this->belongsTo(User::class, 'user_id');
    }
}
