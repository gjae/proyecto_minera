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
        'fecha_nacimiento', 'mina_id','eps','pension',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date', 
        'fecha_nacimiento' => 'date'
    ];

    public function ajustes(){
        return $this->hasMany('App\Models\personal\AjustePersona');
    }

    public function mis_movimientos_minas(){
        return $this->hasMany('App\Models\minas\MovimientosMinas');
    }

    public function mina(){
        return $this->belongsTo('App\Models\Mina');
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

    public function solicitudes_materiales(){
        return $this->hasMany('App\Models\inventario\EgresoMaterial');
    }

    public function transporte(){
        return $this->hasMany('App\Models\transporte\Transporte', 'persona_id');
    }

    public function liquidacion(){
        return $this->hasOne('App\Models\personal\Liquidacion');
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

    public static function getSalario($tipo_nomina, $sueldo){
        $total_persona = 0;

        switch ($tipo_nomina) {
            case 'Q': {
                return $sueldo / 2;
                break;
            }
            
            case 'S':{
                return $sueldo / 4;
                break;
            }

            case 'M':{
                return $sueldo;
                break;
            }
        }
    }
}
