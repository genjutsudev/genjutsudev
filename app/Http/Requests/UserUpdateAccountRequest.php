<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\UserGenderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

/**
 * @property string $user_gender
 * @property array $user_preferences
 */
class UserUpdateAccountRequest extends FormRequest
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
            'user_gender' => ['required', new Rules\Enum(UserGenderEnum::class)],
            'user_preferences.*' => ['integer', 'max:1'],
        ];
    }
}
