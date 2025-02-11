<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProduto extends FormRequest
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
            "nome"                  => "required|max:200|string",
            "valor"                 => "required|numeric",
            "descricao"             => "required|string",
            "imagem"                => "nullable|image",
            "sku"                   => "string|max:200",
            "ean"                   => "string|max:200",
            "detalhes"              => "nullable|json",
            "estoque_quantidade"    => "nullable|integer",
            "subcategoria_id"       => "required|integer"
        ];
    }
}
