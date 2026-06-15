<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->user()->id;

        return [
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $userId,
            'email'    => 'required|email|max:100|unique:users,email,' . $userId,
        ];
    }
}
