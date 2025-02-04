<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentacaoEstoque extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_movimentacao_estoque';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [ 'operacao', 'quantidade', 'produto_estoque_id' ];

    protected $hidden = [ "created_at", "updated_at", "deleted_at" ];

    public function estoque() 
    {
        //UMA movimentacao PERTENCE A UM estoque
        return $this->belongsTo(ProdutoEstoque::class);
    }
}
