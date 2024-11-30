<?php

namespace App\Http\Requests;

use App\Rules\UrlPattern;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFarmacia extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required',
            'cnpj' => 'required|size:14',
            'cep' => 'required|size:8',
            'logradouro' => 'required',
            'numero' => 'required|integer',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',

            'responsavel.nome' => 'required',
            'responsavel.email' => 'required|email',
            'responsavel.telefone' => 'required|size:11'
        ];
    }
}
