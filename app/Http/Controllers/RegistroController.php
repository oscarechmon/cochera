<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class RegistroController extends Controller
{
    public function index(Request $request){
        $query = Registro::query();
        if ($request->filled('nombre_propietario')) {
            $query->where('nombre_propietario', 'like', '%' . $request->nombre_propietario . '%');
        }
        if ($request->filled('marca_auto')) {
            $query->where('marca_auto', 'like', '%' . $request->   marca_auto . '%');
        }

        if ($request->filled('placa_auto')) {
            $query->where('placa_auto', 'like', '%' . $request->placa_auto . '%');
        }
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('created_at', [$request->fecha_inicio, $request->fecha_fin]);
        }
        $data = $query->orderBy('id', 'desc')->get();

        return view('admin.registro.view', compact('data'));
    }
    public function store(Request $request){
        $data = new Registro();
        $data->nombre_propietario  = $request->nombre_propietario;
        $data->marca_auto  = $request->marca_auto;
        $data->placa_auto  = $request->placa_auto;
        $data->precio_pagado  = $request->precio_pagado;
        $data->status  = 1;


         // Generar PDF
         $pdf = PDF::loadView('pdf_template', [
            'nombre_propietario' => $data->nombre_propietario,
            'marca_auto' => $data->marca_auto,
            'placa_auto' => $data->placa_auto,
            'precio_pagado' => $data->precio_pagado,
            'created_at' => Carbon::now()->format('H:i'),
        ]);

        // Definir el nombre del archivo
        $filename = $data->nombre_propietario.'-'.$data->placa_auto.'-'.$data->created_at . '.pdf';

        // Guardar el PDF en el sistema de archivos público
        Storage::put('public/pdf/' . $filename, $pdf->output());

        // Actualizar la URL del PDF en el registro
        $data->url_pdf = Storage::url('pdf/' . $filename);


        // $userEmail = 'oscarechegaraym@gmail.com'; // Cambia esto por la dirección de correo a la que deseas enviar el PDF

        // Mail::send([], [], function ($message) use ($userEmail, $pdf) {
        //     $message->to($userEmail)
        //         ->subject('PDF generado desde Laravel')
        //         ->attachData($pdf->output(), 'registro_auto.pdf', [
        //             'mime' => 'application/pdf',
        //         ]);
        // });
        
        $data->save();
        return back()->with('registercreate','¡El registro ha sido creado con éxito!');
    }
    public function update(Request $request){
        $data = Registro::findOrFail($request->id);
        $data->nombre_propietario  = $request->nombre_propietario;
        $data->marca_auto  = $request->marca_auto;
        $data->placa_auto  = $request->placa_auto;
        $data->precio_pagado  = $request->precio_pagado;
        $data->status  = 1;
        $data->save();
        return back()->with('registerupdate','El registro ha sido modificado con éxito!');
    }
    public function disable(Request $request){
        $data = Registro::findOrFail($request->id);
        $data->status = 0;
        $data->save();
        return back()->with('registerdisable','Registro inhabilitado');
    }
    public function enable(Request $request){
        $user = Registro::findOrFail($request->id);
        $user->status = 1;
        $user->save();
        return back()->with('registerenable','Registro habilitado');
    }
    public function registroSelected($id){
        $data=Registro::where('id',$id)->first();
        return response()->json($data);
    }
    public function enviarCorreo(Request $request, $id)
    {
        // Obtener el registro por ID
        $data = Registro::findOrFail($id);

        // Generar el PDF
        $pdf = PDF::loadView('pdf_template', [
            'nombre_propietario' => $data->nombre_propietario,
            'marca_auto' => $data->marca_auto,
            'placa_auto' => $data->placa_auto,
            'precio_pagado' => $data->precio_pagado,
            'created_at' => Carbon::now()->format('H:i'),
        ]);

        // Definir el nombre del archivo PDF
        $filename = $data->id . '.pdf';

        // Guardar el PDF en el almacenamiento
        Storage::put('public/pdf/' . $filename, $pdf->output());

        // Actualizar la URL del PDF en el registro (si es necesario)
        $data->url_pdf = Storage::url('pdf/' . $filename);
        $data->save();

        // Correo electrónico al usuario especificado
        $userEmail = $request->input('email'); // Obtener el correo electrónico del formulario

        Mail::send([], [], function ($message) use ($userEmail, $pdf) {
            $message->to($userEmail)
                ->subject('Envio de ticket')
                ->attachData($pdf->output(), 'ticket.pdf', [
                    'mime' => 'application/pdf',
                ]);
        });

        return back()->with('success', 'El PDF ha sido enviado por correo electrónico.');
    }
}
