<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'value' => 'required|bool'
        ];
    }
}
