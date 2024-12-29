<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_cupons';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['tipo', 'codigo_cupom', 'valor', 'status', 'data_validade', 'configuracoes'];

    protected $hidden = ["created_at", "updated_at", "deleted_at"];
}
