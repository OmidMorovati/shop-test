<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 *
 * Properties:
 *
 * @property int id
 * @property int order_id
 * @property int product_id
 * @property int count
 * @property int price
 * @property string created_at
 * @property string updated_at
 *
 */

class OrderItem extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
}
