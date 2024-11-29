<?php

namespace App\Models;

use App\Rules\Sha1;
use App\Rules\UrlPattern;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmacia extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nome', 'nome_visualizacao', 'cnpj', 'cep', 'logradouro', 'complemento', 'numero', 'bairro', 'cidade', 'uf', 'dados_receita', 'responsavel_id'
    ];

    public function rules() {
        return [
            'nome' => 'required',
            'nome_visualizacao' => ['required', new UrlPattern, 'unique:farmacias,nome_visualizacao'],
            'cnpj' => 'required|size:14|unique:farmacias,cnpj',
            'cep' => 'required|size:8',
            'logradouro' => 'required',
            'numero' => 'required|integer',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',

            'responsavel.nome' => 'required',
            'responsavel.email' => 'required|email',
            'responsavel.telefone' => 'required|size:11',
            'responsavel.senha' => ['required', new Sha1]
        ];
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'responsavel_id', 'dados_receita'
    ];

    public function responsavel() {
        //UMA farmacia PERTENCE A UM responsavel
        return $this->belongsTo(Responsavel::class);
    }
}
