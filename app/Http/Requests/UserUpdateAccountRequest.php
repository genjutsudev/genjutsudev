<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\UserGenderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

/**
 * @property array $user_birthday
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
            'user_birthday.day' => ['required', 'integer', 'min:1', 'max:31'],
            'user_birthday.month' => ['required', 'integer', 'min:1', 'max:12'],
            'user_birthday.year' => ['required', 'integer', 'min:1971', 'max:' . date('Y')],
            'user_gender' => ['required', new Rules\Enum(UserGenderEnum::class)],
            'user_preferences.*' => ['integer', 'max:1'],
        ];
    }
}
