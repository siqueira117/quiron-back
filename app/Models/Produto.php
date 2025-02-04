<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_produtos';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nome', 'valor', 'descricao', 'detalhes', 'img_uri', 'sku', 'ean', 'estoque_quantidade', 'subcategoria_id'
    ];

    protected $hidden = [
        "created_at", "updated_at", "deleted_at"
    ];

    public function subcategoria() 
    {
        //UM produto PERTENCE A UMA subcategoria
        return $this->belongsTo(Subcategoria::class);
    }
}
