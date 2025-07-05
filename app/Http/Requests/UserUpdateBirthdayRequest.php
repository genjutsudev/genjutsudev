<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property array $user_birthday
 */
class UserUpdateBirthdayRequest extends FormRequest
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
        $is_already_set = $this->user()->birthday !== null;
        $curr_year = date('Y');

        return [
            'user_birthday.day' => ['required', 'integer', 'min:1', 'max:31', Rule::prohibitedIf($is_already_set)],
            'user_birthday.month' => ['required', 'integer', 'min:1', 'max:12', Rule::prohibitedIf($is_already_set)],
            'user_birthday.year' => ['required', 'integer', 'min:1971', "max:$curr_year", Rule::prohibitedIf($is_already_set)],
        ];
    }

    public function messages(): array
    {
        return [
            'user_birthday.*.prohibited' => 'Дату рождения можно установить только один раз.', // @todo i18n
        ];
    }
}
