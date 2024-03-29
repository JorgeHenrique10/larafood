<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tenant_id' => ['required', 'exists:tenants,id'],
            'table_id' => ['nullable', 'exists:tables,id'],
            'comment' => ['nullable', 'max:1000'],
            'products' => ['required'],
            'products.*.id' => ['required', 'exists:products,id'],
            'products.*.qtd' => ['required', 'integer'],
        ];
    }
}
