<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_clientes';

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['id', 'nome', 'tel_celular', 'email'];

    protected $hidden = ["created_at", "updated_at", "deleted_at"];

    public function enderecos() {
        //UM responsavel TEM UMA farmacia
        return $this->hasMany(ClienteEndereco::class);
    }
}
