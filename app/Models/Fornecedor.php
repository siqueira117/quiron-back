<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;
    protected $table = 'fornecedores';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'cnpj',
        'email',
        'tel_celular'
    ];
}
