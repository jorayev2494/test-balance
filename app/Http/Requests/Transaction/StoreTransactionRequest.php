<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'income' => ['nullable', 'required_without:cost', 'prohibited_unless:cost,null', 'numeric', 'min:0.5'],
            'cost' => ['nullable', 'required_without:income', 'prohibited_unless:income,null' , 'numeric', 'min:0.1'],
        ];
    }
}
