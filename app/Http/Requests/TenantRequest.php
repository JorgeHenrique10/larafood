<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
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
        $id = $this->segment(3);
        $roles = [
            'name' => ['required', "unique:tenants,name,$id,id", 'min:3', 'max:255'],
            'email' => ['required', "unique:tenants,email,$id,id", 'email'],
            'cnpj' => ['required', 'digits:14', "unique:tenants,cnpj,$id,id"],
            'logo' => ['required', 'image', 'mimes:png,jpg'],
            'active' => ['required', 'in:Y,N'],
            'subscription' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date'],
            'subscription_id' => ['nullable', 'max:255'],
            'subscription_active' => ['nullable', 'boolean'],
            'subscription_suspended' => ['nullable', 'boolean']
        ];

        if ($this->method() == 'PUT') {
            $roles['logo'] = ['nullable', 'image'];
        }

        return $roles;
    }
}
