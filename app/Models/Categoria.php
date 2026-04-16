<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    protected $fillable = [
        'nombre_categoria',
        'descripcion_categoria',
        'estado_categoria',
    ]; 
    
    public function phones()
{
    return $this->hasMany(\App\Models\Phones::class, 'id_categoria');
}

}
