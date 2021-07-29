<?php

namespace App\Http\Requests\ProductRequests;

use App\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;

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
        return isset($this->user()->store) && $this->user()->can(Permission::ADD_PRODUCTS);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => ['required', 'string'],
            'price' => ['required', 'numeric'],
        ];
    }
}
