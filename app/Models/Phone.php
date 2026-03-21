<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Phone extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_phone';
    protected $fillable = [
        "phone_band",
        "phone_model",
        "phone_price",
        "phone_display_size",
        "phone_is_smartphone"
    ];
}