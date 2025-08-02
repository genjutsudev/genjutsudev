<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $user_profilelink
 */
class UserUpdateProfilelinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_profilelink' => ['required', 'string', 'min:5', 'max:32', 'regex:/^(?!_)(?!.*__)[a-zA-Z0-9_]+(?<!_)$/'],
        ];
    }
}
