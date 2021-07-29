<?php

namespace App\Http\Requests\AuthRequests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * @property string name
 * @property string email
 * @property string password
 */
class RegisterRequest extends FormRequest
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
        return [
            'name'     => ['required', 'string'],
            'email'    => ['required', Rule::unique(app(User::class)->getTable(), 'email')],
            'password' => ['required', 'string', Password::min(8)],
        ];
    }
}
