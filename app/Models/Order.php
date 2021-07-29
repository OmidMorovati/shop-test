<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * Properties:
 *
 * @property int id
 * @property int buyer_id
 * @property int total_price
 * @property string created_at
 * @property string updated_at
 *
 */
class Order extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
