<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * Properties:
 *
 * @property int id
 * @property int store_id
 * @property string name
 * @property string price
 * @property string created_at
 * @property string updated_at
 *
 */
class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
