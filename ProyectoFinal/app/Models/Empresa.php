<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empresa extends Model
{
    use HasFactory;

    public function poblacio()
    {
        return $this->belongsTo(Poblacio::class);
    }

    public function countEstades()
    {
        return $this->join('estadas', 'estadas.empresa_id', '=', 'empresas.id')->where('empresa_id', $this->id)->count('estadas.id');
    }

    public function avgValoracio()
    {
        $avg = round($this->join('estadas', 'estadas.empresa_id', '=', 'empresas.id')->orderBy('empresas.id')->where('empresa_id', $this->id)->avg('estadas.evaluation'), 1);
        $count = $this->join('estadas', 'estadas.empresa_id', '=', 'empresas.id')->orderBy('empresas.id')->where('empresa_id', $this->id)->count('estadas.evaluation');

        if ($count == 0) {
            return "Ninguna";
        } else {
            return $avg;
        }

    }

    public function contactes()
    {
        $count = $this->join('contactes', 'contactes.empresa_id', '=', 'empresas.id')->where('empresa_id', $this->id)->count('contactes.id');
        $firstContact = $this->join('contactes', 'contactes.empresa_id', '=', 'empresas.id')->where('empresa_id', $this->id)->first('contactes.*');

        if ($count == 0) {
            return "Ningun";
        } else if ($count == 1) {
            return $firstContact->name . ": " . $firstContact->phonenumber;
        } else if ($count > 1) {
            $count--;
            return $firstContact->name . ": " . $firstContact->phonenumber . ", ...(" . $count . ")";
        }
    }
    
    public function estada()
    {
        return $this->hasMany(Estada::class);
    }
    
    public function contacte()
    {
        return $this->hasMany(Contacte::class);
    }
}
