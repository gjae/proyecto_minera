<?php
namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model 
{
    protected $table = 'personas';
    protected $fillable = [
        'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido',
        'identificacion', 'fecha_ingreso', 'telefono', 'direccion_persona', 'sueldo_basico',
        'sitio_trabajo_id', 'tipo_sangre_id', 'cargo_id', 'ciudad_id', 'estado_persona', 'sexo'
    ];

    protected $casts = ['fecha_ingreso' => 'date'];

    public function ajustes(){
        return $this->hasMany('App\Models\personal\AjustePersona');
    }

    public function ciudad(){
        return $this->belongsTo('App\Models\Ciudad');
    }

    public function sitio_trabajo(){
        return $this->belongsTo('App\Models\personal\SitioTrabajo', 'sitio_trabajo_id');
    }

    public function cargo(){
        return $this->belongsTo('App\Models\personal\Cargo', 'cargo_id');
    }
}
