<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            padding: 0;
            margin: 0;
            width: 80mm; /* Ancho del ticket */
            height: 100vh; /* Ajuste automático de la altura a la altura total de la ventana */
            display: flex;
            justify-content: center; /* Centrado horizontal */
            align-items: center; /* Centrado vertical */
            margin: auto;
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
            margin: auto;
            display: block;
            height: 100px;
            width: 100px;
        }
    </style>
</head>
<body>
    <div class="contenido">
        <div class="caja-1">
            <img src="./images/logo.png" alt="una imagen">
            <h1>ESTACIONAMIENTO</h1>
            <h3>BIENVENIDOS</h3>
            <span>{!! $barcodeHTML !!}</span>
            <h2>{{ $placa_auto }}</h2><br><br> 
            <span>PROPIETARIO:{{ $nombre_propietario }}</span><br><br>
            <span>MARCA:{{ $marca_auto }}</span><br><br>
            <span>PRECIO PAGADO: {{ $precio_pagado }}</span><br><br>
            <span>ENTRADA: {{ $created_at }}</span><br><br>
        </div>
    </div>
</body>
</html>
