<?php

namespace App\Helpers;

use App\Helpers\Contracts\AlumIndContract;
use Illuminate\Http\Request;
use App\TipoNota;
use App\AlumnosHasIndicadores;
use App\Indicadores;
use Log;

class AlumInd implements AlumIndContract
{
    //Actualiza el promedio
    public function actProm($alumno,$indicador){
        $obj=AlumnosHasIndicadores::where('indicadores_id',$indicador)
            ->where('alumnos_id',$alumno)
            ->first();
        if ($obj) {
            $notas=TipoNota::where('indicadores_id',$indicador)
                ->with(['notas'=>function($query) use($alumno){
                    $query->where('alumnos_id',$alumno);
                }])
                ->get();
            $acum=0;
            if($notas->count()){
            foreach ($notas as $nota) {
                if($nota->notas->count()){
                    $acum+=$nota->notas[0]->calificacion;
                }
            }
            }
            $elem=AlumnosHasIndicadores::find($obj->id);
            $elem->prom=$acum? $acum/$notas->count(): $acum; // Validamos si acum tiene mas que cero
            $elem->save();
            return true;
        }
        return false;
    }

    public function addActProm($alumno,$indicador){
        $obj=AlumnosHasIndicadores::where('indicadores_id',$indicador)
            ->where('alumnos_id',$alumno)
            ->first();
        if (!$obj) {
            $alumInd=new AlumnosHasIndicadores;
            $alumInd->indicadores_id=$indicador;
            $alumInd->alumnos_id=$alumno;
            $alumInd->prom=0;
            $alumInd->save();
        }
        return $this->actProm($alumno,$indicador);
    }

    public function actPromPorIndic($indicador){
        $alumnos=Indicadores::with('materias_has_periodos.materias_has_niveles.niveles_has_anios.alumnos')->find($indicador);
        if ($alumnos) {
            $alumnos=$alumnos->materias_has_periodos->materias_has_niveles->niveles_has_anios->alumnos;
            foreach ($alumnos as $alumno) {
                $this->actProm($alumno->id,$indicador);
            }
            return true;
        }
        return false;
    }

}