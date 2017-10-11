<?php

namespace App\Models\compras;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'archivos';
    protected $fillable = [
    	'nombre_original',
    	'ruta',
    	'tipo_archivo',
    	'nombre_archivo',
    	'tamano',
    	'orden_id',
    	'extension',
        'comentario'
    ];
    private $extensiones = [
    	'png', 'PNG',
    	'jpg', 'JPG',
    	'jpeg', 'JPEG',
    	'gif', 'GIF',
    	'pdf', 'PDF',
        'xlsx', 'xls',
        'XLSX', 'XLX'
    ];

    public function orden(){

    	return $this->belongsTo('App\Models\compras\Orden');
    }

    public function setExtensionAttribute($valor){
    	if(! (in_array($valor, $this->extensiones)) )
    		throw new \Exception("LA EXTENSION ".$valor.' DE UNO DE LOS ARCHIVOS NO ESTA PERMITIDA', 1);

    	$this->attributes['extension'] = $valor;
    		
    }
}
