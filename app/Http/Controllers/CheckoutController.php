<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'tipo_entrada' => 'required|in:normal,menu',
            'telefono_cobro' => 'required|in:634 46 90 24,671 78 40 16',
        ]);

        // Generar código único FIESTA-XXX
        do {
            $codigo = 'FIESTA-' . strtoupper(Str::random(3));
        } while (Entrada::where('codigo_reserva', $codigo)->exists());

        $entrada = Entrada::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'tipo_entrada' => $request->tipo_entrada,
            'codigo_reserva' => $codigo,
            'telefono_cobro' => $request->telefono_cobro,
            'estado_pago' => false,
        ]);

        return redirect()->route('checkout.success', $entrada->codigo_reserva);
    }

    public function success($codigo)
    {
        $entrada = Entrada::where('codigo_reserva', $codigo)->firstOrFail();
        
        return view('checkout.success', compact('entrada'));
    }
}
