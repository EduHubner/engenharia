<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Clientes;

class Construcoes extends Model
{
    use HasFactory;

    public function cliente() {
        return $this->belongsTo(Clientes::class);
    }

    public function getSituacaoAttribute(){

        $now = \Carbon\Carbon::now('GMT-3');
        $ini = \Carbon\Carbon::create($this->dataInicio,'GMT-3');
        $final = \Carbon\Carbon::create($this->dataFim,'GMT-3');

        if($now->lt($ini)){ //a iniciar

            $r = 'A iniciar';
        }
        elseif($now->lt($final)){ //construindo

            $r = 'Em construção';
            
        }
        else{ //após terminar

            $r = 'Finalizado';

        }
        return $r;
        
    }
}
