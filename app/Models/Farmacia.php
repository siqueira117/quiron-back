<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Farmacia extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nome', 'nome_visualizacao', 'cnpj', 'cep', 'logradouro', 'complemento', 'numero', 'bairro', 'cidade', 'uf', 'responsavel_id'
    ];

    public function rules() {
        return [
            'nome' => 'required',
            'nome_visualizacao' => 'required',
            'cnpj' => 'required|size:14',
            'cep' => 'required|size:8',
            'logradouro' => 'required',
            'numero' => 'required|integer',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',

            'responsavel.nome' => 'required',
            'responsavel.email' => 'required|email',
            'responsavel.telefone' => 'required|size:11',
        ];
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'responsavel_id',
    ];

    public function responsavel() {
        //UMA farmacia PERTENCE A UM responsavel
        return $this->belongsTo(Responsavel::class);
    }
}
