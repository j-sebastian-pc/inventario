<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Papeleria extends Model
{
    use HasFactory;

    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'papeleria';

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'tipo_papeleria',
        'cantidad_papeleria',
        'oficina_papeleria',
        'fecha_papeleria',
        'fechaAsesor_papeleria',
    ];

    /**
     * La clave primaria asociada con la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id_papeleria';
}