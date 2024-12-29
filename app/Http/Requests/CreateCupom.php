<?php

namespace App\Http\Requests;

use App\Enums\CupomStatus;
use App\Enums\CupomTipo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCupom extends FormRequest
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
            "tipo"          => ["required", "string", Rule::enum(CupomTipo::class)],
            "codigo_cupom"  => "required|string|max:50",
            "valor"         => "required|numeric|gt:0",
            "status"        => ["string", Rule::enum(CupomStatus::class)],
            "data_validade" => "nullable|date"
            //"configuracoes" => ""
        ];
    }
}
