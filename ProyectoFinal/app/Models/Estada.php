<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function tutor()
    {
        $user = $this->join('users', 'users.id', '=', 'estadas.registered_by')->where('users.id', '=', $this->registered_by)->first("users.*");
        return $user->name;
    }

    public function curs()
    {
        return $this->belongsTo(Curs::class);
    }
}
