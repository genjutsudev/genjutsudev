<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

use App\Core\Model\User\UseCase\User\Create;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    public function __construct(
        private Create\Handler $create
    ) {
        $this->create = $create;
    }

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:user_users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function registere()
    {
        $command = Create\Command::fromRequest($this);

        try {
            $user = $this->create->handle($command);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }

        event(new Registered($user));

        Auth::login($user);
    }
}
