<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteEndereco extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_cliente_enderecos';

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['id', 'cep', 'logradouro', 'complmento', 'numero', 'bairro', 'cidade', 'uf', 'cliente_id'];

    protected $hidden = ["created_at", "updated_at", "deleted_at"];

    public function cliente() 
    {
        //UM endereco PERTENCE A UM cliente
        return $this->belongsTo(Cliente::class);
    }
}
