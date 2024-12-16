<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entregador extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_entregadores';

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['nome', 'tel_celular'];

    public function rules() {
        return [ 'nome' => 'required|max:200', 'tel_celular' => 'required|size:11' ];
    }

    protected $hidden = [
        "created_at", "updated_at", "deleted_at"
    ];
}
