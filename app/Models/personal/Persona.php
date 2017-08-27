<?php
namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Persona extends Model 
{
    protected $table = 'personas';
    protected $fillable = [
        'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido',
        'identificacion', 'fecha_ingreso', 'telefono', 'direccion_persona', 'sueldo_basico',
        'sitio_trabajo_id', 'tipo_sangre_id', 'cargo_id', 'ciudad_id', 'estado_persona', 'sexo',
        'fecha_nacimiento',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date', 
        'fecha_nacimiento' => 'date'
    ];

    public function ajustes(){
        return $this->hasMany('App\Models\personal\AjustePersona');
    }

    public function ciudad(){
        return $this->belongsTo('App\Models\Ciudad');
    }

    public function sitio_trabajo(){
        return $this->belongsTo('App\Models\personal\SitioTrabajo', 'sitio_trabajo_id');
    }

    public function nominas(){
        return $this->hasMany('App\Models\personal\DetalleNomina');
    }

    public function tipo_sangre(){
        return $this->belongsTo('App\Models\personal\TipoSangre', 'tipo_sangre_id');
    }

    public function cargo(){
        return $this->belongsTo('App\Models\personal\Cargo', 'cargo_id');
    }

    /**
     * SETTERS FUNCTIONS
     */

    public function setFechaNacimientoAttribute($old){
        $this->attributes['fecha_nacimiento'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function setFechaIngresoAttribute($old){
        $this->attributes['fecha_ingreso'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function setPrimerNombreAttribute($old){
        $this->attributes['primer_nombre'] = ucfirst($old);
    }

    public function setSegundoNombreAttribute($old){
        $this->attributes['segundo_nombre'] = ucfirst($old);
    }

    public function setPrimerApellidoAttribute($old){
        $this->attributes['primer_apellido'] = ucfirst($old);
    }

    public function setSegundoApellidoAttribute($old){
        $this->attributes['segundo_apellido'] = ucfirst($old);
    }
}
