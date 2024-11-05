<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{
    use HasFactory;

    protected $table = 'responsaveis';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nome', 'email', 'telefone'
    ];

    public function farmacia() {
        //UM responsavel TEM UMA farmacia
        return $this->hasOne(Farmacia::class);
    }
}
