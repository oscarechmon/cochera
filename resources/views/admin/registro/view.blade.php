@extends('admin.app')
@section('main')

<div class="container-fluid">
    @if (session('clientecreated'))
        <div class="alert alert-success fade-out mt-3" role="alert">
            <h4 class="alert-title">Realizado con éxito</h4>
            <div class="text-secondary">{{ session('clientecreated') }}</div>
        </div>
    @endif
    @if (session('clienteupdate'))
        <div class="alert alert-success fade-out mt-3" role="alert">
            <h4 class="alert-title">Realizado con éxito</h4>
            <div class="text-secondary">{{ session('clienteupdate') }}</div>
        </div>
    @endif

    @if (session('clientedisable'))
        <div class="alert alert-warning fade-out mt-3" role="alert">
            <h4 class="alert-title">Realizado con éxito</h4>
            <div class="text-secondary">{{ session('clientedisable') }}</div>
        </div>
    @endif

    @if (session('clienteenable'))
        <div class="alert alert-success fade-out mt-3" role="alert">
            <h4 class="alert-title">Realizado con éxito</h4>
            <div class="text-secondary">{{ session('clienteenable') }}</div>
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Error:</strong> Por favor, corrige los siguientes errores.
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="card mt-3">
        <div class="card-header">
            <div class="d-flex align-items-center w-100">
                <h2 class="card-title col">REGISTRO</h2>
                <button type="button" class="btn btn-primary col-auto ms-auto" data-bs-toggle="modal" data-bs-target="#nuevoRegistro">
                    CREAR NUEVO registro
                </button>
            </div>
            
        </div>
        <div class="card-body">
        <div class="card-header">
            <form action="{{ route('mis-registros') }}" method="GET">
                <div class="row">
                    <div class="form-group col-md-3 col-sm-12">
                        <label for="">NOMBRE DEL PROPIETARIO</label>
                        <input type="text" name="nombre_propietario" class="form-control" value="{{ request('nombre_propietario') }}">
                    </div>
                    <div class="form-group col-md-3 col-sm-12">
                        <label for="">MARCA DEL AUTO</label>
                        <input type="text" name="marca_auto" class="form-control" value="{{ request('marca_auto') }}">
                    </div>
                    <div class="form-group col-md-3 col-sm-12">
                        <label for="">PLACA DEL AUTO</label>
                        <input type="text" name="placa_auto" class="form-control" value="{{ request('placa_auto') }}">
                    </div>
                    <div class="form-group col-md-3 col-sm-12">
                        <label for="">TIPO VEHICULO</label>
                        <select name="tipo_vehiculo" class="js-example-basic-single" value="{{ request('tipo_vehiculo') }}">
                            <option value="">SELECCIONE TIPO VEHICULO</option>
                            <option value="AUTO">AUTO</option>
                            <option value="CAMIONETA">CAMIONETA</option>
                            <option value="VAN">VAN</option>
                            <option value="CAMIÓN">CAMIÓN</option>
                            <option value="MOTO">MOTO</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3 col-sm-12">
                        <label for="">PRECIO PAGADO</label>
                        <input type="text" name="precio_pagado" class="form-control" value="{{ request('precio_pagado') }}">
                    </div>
                    <div class="form-group col-md-3 col-sm-12">
                        <label for="">FECHA DESDE</label>
                        <input type="date" name="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
                    </div>
                    <div class="form-group col-md-3 col-sm-12">
                        <label for="">FECHA HASTA</label>
                        <input type="date" name="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
                    </div>
                    
                    <div class="text-center m-3">
                        <input type="submit" value="Buscar" class="btn btn-primary text-center">
                    </div>
                    
                    
                </div>
            </form>
        </div>
        <a href="{{ route('exportar-registros', request()->all()) }}" class="btn btn-success">Exportar a Excel</a>
       
            <table class="table table-hover table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>OPCIONES</th>
                        <th>NOMBRE DEL PROPIETARIO</th>
                        <th>MARCA DEL AUTO</th>
                        <th>PLACA DEL AUTO</th>
                        <th>PRECIO PAGADO</th>
                        <th>TIPO VEHICULO</th>     
                        <th>FECHA GENERADO</th>
                        <th>FECHA ACTUALIZADO</th>
                        <th>ENVIAR AL CORREO</th>
                        <th>TICKET</th>
                        <th>ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr class="text-center">
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <form action="{{ route('eliminar-registro', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-ghost-danger btn-sm edit-button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <button type="button" class="btn btn-ghost-warning btn-sm edit-button" onclick="traerDataRegistro({{$item->id}})" data-id="{{ $item->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                @if($item->status)
                                    <form action="{{ route('inhabilitar-registro', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-ghost-warning btn-sm">
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('habilitar-registro', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-ghost-info btn-sm">
                                            <i class="fas fa-check"></i> 
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                        <td>{{ $item->nombre_propietario }}</td>
                        <td>{{ $item->marca_auto }}</td>
                        <td>{{ $item->placa_auto }}</td>
                        <td>{{ $item->precio_pagado }}</td>
                        <td>{{ $item->tipo_vehiculo }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#enviarCorreoModal">
                            Enviar PDF por Correo Electrónico
                        </button></td>
                        <td><a href="{{ asset($item->url_pdf) }}" target="_blank">Descargar PDF</a></td>
                        <td class="d-flex align-items-center justify-content-center">
                            @if($item->status)
                                <span class="badge bg-success-lt">PENDIENTE</span>
                            @else
                                <span class="badge bg-danger-lt">FINALIZADO</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="modal fade" id="nuevoRegistro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="nuevoRegistroLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoRegistroLabel">NUEVO REGISTRO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('crear-registro') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="nombre_propietario">NOMBRE PROPIETARIO:</label>
                                <input type="text" class="form-control" id="nombre_propietario" name="nombre_propietario">
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="marca_auto">MARCA DE AUTO:</label>
                                <input type="text" class="form-control" id="marca_auto" name="marca_auto">
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="placa_auto">PLACA DEL AUTO:</label>
                                <input type="text" class="form-control" id="placa_auto" name="placa_auto">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="precio_pagado">PRECIO PAGADO:</label>
                                <input type="text" class="form-control" id="precio_pagado" name="precio_pagado">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                            <label for="">TIPO VEHICULO</label>
                                <select name="tipo_vehiculo" class="js-example-basic-single">
                                    <option value="">SELECCIONE TIPO VEHICULO</option>
                                    <option value="AUTO">AUTO</option>
                                    <option value="CAMIONETA">CAMIONETA</option>
                                    <option value="VAN">VAN</option>
                                    <option value="CAMIÓN">CAMIÓN</option>
                                    <option value="MOTO">MOTO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>              
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="actualizarRegistroModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="actualizarRegistroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actualizarRegistroModalLabel">Actualizar Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('actualizar-registro') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="idRegistro" name="id">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="nombre_propietario">NOMBRE PROPIETARIO:</label>
                                <input type="text" class="form-control" id="updatenombre_propietario" name="nombre_propietario">
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="marca_auto">MARCA DE AUTO:</label>
                                <input type="text" class="form-control" id="updatemarca_auto" name="marca_auto">
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="placa_auto">PLACA DEL AUTO:</label>
                                <input type="text" class="form-control" id="updateplaca_auto" name="placa_auto">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="precio_pagado">PRECIO PAGADO:</label>
                                <input type="text" class="form-control" id="updateprecio_pagado" name="precio_pagado">
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="updatetipo_vehiculo">TIPO VEHICULO</label>
                                    <select name="tipo_vehiculo" id="updatetipo_vehiculo" class="js-example-basic-single">
                                        <option value="">SELECCIONE TIPO VEHICULO</option>
                                        <option value="AUTO">AUTO</option>
                                        <option value="CAMIONETA">CAMIONETA</option>
                                        <option value="VAN">VAN</option>
                                        <option value="CAMIÓN">CAMIÓN</option>
                                        <option value="MOTO">MOTO</option>
                                    </select>
                                </div>
                            </div>    
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="enviarCorreoModal" tabindex="-1" role="dialog" aria-labelledby="enviarCorreoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @if($data->isEmpty())
            <form action="#" method="POST">
            @else
            <form action="{{ route('enviar.correo', ['id' => $item->id]) }}" method="POST">
            @endif
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="enviarCorreoModalLabel">Enviar PDF por Correo Electrónico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Ingrese el correo electrónico">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</main>
@section('js')
<script>
    var traerDataRegistro = function(id){
        const urlRegistro=`mis-registros/${id}`;
        $.ajax({
            url: urlRegistro,
            method: 'GET',
            success: function(response) {
                var registro = response;
                $('#idRegistro').val(registro.id);
                $('#updatenombre_propietario').val(registro.nombre_propietario);
                $('#updatemarca_auto').val(registro.marca_auto);
                $('#updateplaca_auto').val(registro.placa_auto);
                $('#updateprecio_pagado').val(registro.precio_pagado);
                $('#updatetipo_vehiculo').val(registro.tipo_vehiculo);
                $('#actualizarRegistroModal').modal('show'); 
            },
            error: function() {
                alert('Error en la solicitud AJAX.');
            }
        });
    };
</script>
<script>
      $('.selectmodal').select2({
        dropdownParent: $('#nuevoRegistroLogistico')
      });   
      $(document).ready(function() {
      $('.js-example-basic-single').selectize();
    });
</script>
@endsection
@endsection