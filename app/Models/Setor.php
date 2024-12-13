<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_setores';

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['id', 'nome'];

    public function rules() {
        return [ 'nome' => 'required|max:200' ];
    }

    protected $hidden = [
        "created_at", "updated_at", "deleted_at"
    ];

    public function categoria() 
    {
        //UM setor TEM UMA categoria
        return $this->hasOne(Categoria::class);
    }   
}
