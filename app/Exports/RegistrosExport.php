<?php

namespace App\Exports;

use App\Models\Registro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class RegistrosExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;

    protected $fechaInicio;
    protected $fechaFin;
    protected $nombrePropietario;
    protected $marcaAuto;
    protected $placaAuto;
    protected $tipo_vehiculo;

    public function __construct($fechaInicio, $fechaFin, $nombrePropietario, $marcaAuto, $placaAuto,$tipo_vehiculo)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->nombrePropietario = $nombrePropietario;
        $this->marcaAuto = $marcaAuto;
        $this->placaAuto = $placaAuto;
        $this->tipo_vehiculo = $tipo_vehiculo;
    }

    public function collection()
    {
        $query = Registro::query();

        if ($this->fechaInicio) {
            $query->whereDate('created_at', '>=', $this->fechaInicio);
        }

        if ($this->fechaFin) {
            $query->whereDate('created_at', '<=', $this->fechaFin);
        }

        if ($this->nombrePropietario) {
            $query->where('nombre_propietario', 'like', '%' . $this->nombrePropietario . '%');
        }

        if ($this->marcaAuto) {
            $query->where('marca_auto', 'like', '%' . $this->marcaAuto . '%');
        }

        if ($this->placaAuto) {
            $query->where('placa_auto', 'like', '%' . $this->placaAuto . '%');
        }
        if ($this->tipo_vehiculo) {
            $query->where('tipo_vehiculo', 'like', '%' . $this->tipo_vehiculo . '%');
        }


        return $query->get();
    }

    public function headings(): array
    {
        return [
            'NOMBRE DEL PROPIETARIO',
            'TIPO VEHICULO',
            'MARCA AUTO',
            'PLACA DEL AUTO',
            'PRECIO PAGADO',
            'FECHA GENERADA',
        ];
    }

    public function map($registro): array
    {
        return [
            $registro->nombre_propietario,
            $registro->tipo_vehiculo,
            $registro->marca_auto,
            $registro->placa_auto,
            $registro->precio_pagado,
            $registro->created_at,
        ];
    }
}
