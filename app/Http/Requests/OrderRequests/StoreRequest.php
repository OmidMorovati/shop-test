<?php

namespace App\Http\Requests\OrderRequests;

use App\Models\Permission;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property integer userId
 */
class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $productTable = (resolve(Product::class))->getTable();
        return [
            'product_id' => ['required', Rule::exists($productTable, 'id')],
        ];
    }
}
