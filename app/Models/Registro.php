<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{   
    protected $table="registros";
    protected $fillable=['nombre_propietario','marca_auto','placa_auto','precio_pagado','url_pdf','tipo_vehiculo'];
    use HasFactory;
}
