<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCliente extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome'          => 'required|string|max:200',
            'tel_celular'   => 'required|string|max:12',
            'email'         => 'nullable|string|max:200',
            
            'endereco'              => 'nullable|array',
            'endereco.cep'          => 'required_with:endereco|string|max:14',
            'endereco.logradouro'   => 'required_with:endereco|string|max:150',
            'endereco.complemento'  => 'nullable|string|max:250',
            'endereco.numero'       => 'required_with:endereco|string|max:10',
            'endereco.bairro'       => 'required_with:endereco|string|max:150',
            'endereco.cidade'       => 'required_with:endereco|string|max:150',
            'endereco.uf'           => 'required_with:endereco|string|max:2',
        ];
    }
}
