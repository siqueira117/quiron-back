<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_subcategorias';

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['id', 'nome', 'categoria_id'];

    protected $hidden = [
        "created_at", "updated_at", "deleted_at", "setor_id"
    ];

    public function rules() {
        return [ 'nome' => 'required|max:200', 'categoria_id' => 'required|number' ];
    }

    public function categoria() 
    {
        //UMA subcategoria PERTENCE A UMA categoria
        return $this->belongsTo(Categoria::class);
    }
}
