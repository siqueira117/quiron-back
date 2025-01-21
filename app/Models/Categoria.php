<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_categorias';

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['id', 'nome', 'setor_id'];

    protected $hidden = [
        "created_at", "updated_at", "deleted_at", "setor_id"
    ];

    public function rules() {
        return [ 'nome' => 'required|max:200', 'setor_id' => 'required|number' ];
    }

    public function setor() 
    {
        //UMA categoria PERTENCE A UM setor
        return $this->belongsTo(Setor::class);
    }

    public function subcategorias() 
    {
        // UMA categoria TEM VÁRIAS subcategorias
        return $this->hasMany(Subcategoria::class);
    }
}
