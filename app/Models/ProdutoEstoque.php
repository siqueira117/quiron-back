<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoEstoque extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_produtos_estoque';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [ 'quantidade', 'produto_id' ];

    protected $hidden = [ "created_at", "updated_at", "deleted_at" ];

    public function produto() 
    {
        //UM estoque PERTENCE A UM produto
        return $this->belongsTo(Produto::class);
    }
}
