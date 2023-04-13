<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    use HasFactory;

    public function nomCognoms()
    {
        return $this->firstname . " " . $this->lastname;
    }
    
    public function cicle()
    {
        return $this->belongsTo(Cicle::class);
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
}
