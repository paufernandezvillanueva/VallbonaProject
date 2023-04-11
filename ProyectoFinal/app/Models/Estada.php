<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estada extends Model
{
    use HasFactory;

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function cicle()
    {
        return $this->belongsTo(Cicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function curs()
    {
        return $this->belongsTo(Curs::class);
    }
}
