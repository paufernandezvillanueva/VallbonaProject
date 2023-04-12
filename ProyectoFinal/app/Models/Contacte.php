<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contacte extends Model
{
    use HasFactory;

    protected $table = 'contactos';

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
