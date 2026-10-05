<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        $entradas = Entrada::orderBy('created_at', 'desc')->get();
        return view('admin.index', compact('entradas'));
    }

    public function markAsPaid($id)
    {
        $entrada = Entrada::findOrFail($id);
        $entrada->estado_pago = true;
        $entrada->save();

        // Aquí lanzaríamos el Job o Evento para enviar el email
        // event(new \App\Events\EntradaPagada($entrada));
        Log::info("Enviando email de confirmación a {$entrada->email} por la entrada {$entrada->codigo_reserva}");

        return redirect()->back()->with('success', 'Entrada marcada como pagada. Email de confirmación programado.');
    }

    public function reject($id)
    {
        $entrada = Entrada::findOrFail($id);
        $nombre = $entrada->nombre;
        $entrada->delete();

        return redirect()->back()->with('success', "La entrada de {$nombre} ha sido rechazada y eliminada.");
    }

    public function downloadCsv()
    {
        $entradas = Entrada::where('estado_pago', true)
            ->orderBy('tipo_entrada')
            ->orderBy('nombre')
            ->get();

        $filename = "lista_entradas_" . date('Ymd_His') . ".csv";
        $handle = fopen('php://output', 'w');

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Añadimos BOM para que Excel (en Windows) reconozca los acentos y el UTF-8
        fputs($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

        // Headers con delimitador ';' para que Excel en español lo separe en columnas
        fputcsv($handle, ['Tipo', 'Nombre', 'Email', 'Teléfono', 'Código Reserva'], ';');

        foreach ($entradas as $entrada) {
            fputcsv($handle, [
                ucfirst($entrada->tipo_entrada),
                $entrada->nombre,
                $entrada->email,
                $entrada->telefono,
                $entrada->codigo_reserva
            ], ';');
        }

        fclose($handle);
        exit;
    }
}
