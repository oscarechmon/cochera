<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            padding: 0;
            margin: auto;
            width: 100mm !important; /* Ancho del ticket */
            height: 100vh; /* Ajuste automático de la altura a la altura total de la ventana */
            display: flex;
            justify-content: center; /* Centrado horizontal */
            align-items: center; /* Centrado vertical */
        }
        .contenido {
            width: 100%;
            height: auto; /* Ajuste automático de la altura según el contenido */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .caja-1 {
            text-align: center;
            background-color: aliceblue;
            padding: 3rem;
            box-sizing: border-box; /* Para incluir el padding dentro del ancho y alto */
        }
        .caja-1 img {
            display: block;
            margin: auto;
            height: 100px;
            width: 100px;
        }
        .caja-2 {
            position: relative;
            text-align: center !important;
            margin: auto !important;
        }
        .caja-2 span{
            text-align: center !important;
            margin: auto !important;
        }
    </style>
</head>
<body>
    <div class="contenido">
        <div class="caja-1">
            <img src="./images/logo.png" alt="una imagen">
            <h1>ESTACIONAMIENTO</h1>
            <h3>BIENVENIDOS</h3>
            <div class="caja-2">
                <span>{!! $barcodeHTML !!}</span>
            </div>
            <h2>{{ $placa_auto }}</h2><br><br> 
            <span style="text-align:center;margin-auto;">PROPIETARIO:{{ $nombre_propietario }}</span><br><br>
            <span>TIPO VEHICULO:{{ $tipo_vehiculo }}</span><br><br>
            <span>MARCA:{{ $marca_auto }}</span><br><br>
            <span>PRECIO PAGADO: {{ $precio_pagado }}</span><br><br>
            <span>ENTRADA: {{ $created_at }}</span><br><br>
        </div>
    </div>
</body>
</html>
