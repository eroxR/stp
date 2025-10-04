<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    //     public function generate()
    // {
    //     // Contenido HTML de prueba
    //     $html = '
    //         <h1>¡Hola, mundo!</h1>
    //         <p>Este es un PDF de prueba generado con Dompdf en Laravel.</p>
    //         <p>¡Funciona!</p>
    //     ';
        
    //     // Carga el HTML en Dompdf
    //     $pdf = pdf::loadHtml($html);
        
    //     // Muestra el PDF en el navegador
    //     // Usamos el método `stream()` para abrirlo en una nueva pestaña del navegador.
    //     // También puedes usar `download()` para forzar la descarga del archivo.
    //     return $pdf->stream('documento-de-prueba.pdf');
    // }
}
