@extends('layouts.resort')

@section('title', 'Casino Real Paradiso - Solo Adultos')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <!-- Hero del Casino -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-amber-950 via-slate-900 to-amber-900 border border-amber-600/50 p-8 shadow-2xl">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-3">
                <div class="flex items-center space-x-2">
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-500/20 text-amber-300 border border-amber-500/40">
                        🔞 Zona Exclusiva para Adultos (+18)
                    </span>
                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-500/40">
                        ✓ CheckAge Superado
                    </span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                    🎰 Sala de Juegos — Casino Real Paradiso
                </h1>
                <p class="text-amber-200/80 text-sm sm:text-base leading-relaxed max-w-2xl">
                    Has superado los controles de los porteros virtuales <code class="text-amber-300 font-mono">CheckAuth</code> y <code class="text-amber-300 font-mono">CheckAge</code>. Disfruta de una velada de entretenimiento exclusivo, ruletas electrónicas y mesas de póker.
                </p>
            </div>
            <div class="bg-amber-950/80 border border-amber-700/60 rounded-xl p-4 text-center min-w-[170px] shadow-lg">
                <span class="text-xs text-amber-300 block font-semibold uppercase tracking-wider">Huésped Autorizado</span>
                <span class="text-lg font-bold text-white block mt-1">{{ Auth::user()->name }}</span>
                <span class="text-xs text-emerald-400 font-mono mt-0.5 inline-block">Edad: {{ Auth::user()->age }} años (&ge; 18)</span>
            </div>
        </div>
    </div>

    <!-- Mesas de Juego Simuladas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-slate-800/60 border border-slate-700 rounded-xl p-5 hover:border-amber-500 transition space-y-3">
            <div class="text-3xl">🎡</div>
            <h3 class="font-bold text-white text-base">Ruleta Francesa VIP</h3>
            <p class="text-xs text-slate-400">Mesa en vivo con crupier digital y apuestas simuladas de alta frecuencia.</p>
            <div class="pt-2 text-xs font-semibold text-amber-400">Apuesta mínima: 50 fichas</div>
        </div>

        <div class="bg-slate-800/60 border border-slate-700 rounded-xl p-5 hover:border-amber-500 transition space-y-3">
            <div class="text-3xl">🃏</div>
            <h3 class="font-bold text-white text-base">Blackjack Royale</h3>
            <p class="text-xs text-slate-400">Mesa clásica de 21 con barajas múltiples y seguro de crupier.</p>
            <div class="pt-2 text-xs font-semibold text-amber-400">Apuesta mínima: 25 fichas</div>
        </div>

        <div class="bg-slate-800/60 border border-slate-700 rounded-xl p-5 hover:border-amber-500 transition space-y-3">
            <div class="text-3xl">🎲</div>
            <h3 class="font-bold text-white text-base">Texas Hold'em Pro</h3>
            <p class="text-xs text-slate-400">Torneo nocturno entre huéspedes mayores de edad del resort.</p>
            <div class="pt-2 text-xs font-semibold text-amber-400">Entrada libre para huéspedes +18</div>
        </div>
    </div>

    <!-- Cuadro de Explicación Técnica -->
    <div class="p-4 rounded-xl bg-slate-800/40 border border-slate-700/80 text-xs text-slate-400 space-y-1">
        <p class="font-semibold text-slate-200">🔍 Comprobación de Seguridad:</p>
        <p>Esta ruta (<code class="text-amber-400 font-mono">/casino</code>) está blindada conjuntamente por:</p>
        <ul class="list-disc list-inside space-y-0.5 text-slate-400 ml-2">
            <li><code class="text-indigo-400 font-mono">CheckAuth</code>: Valida que el visitante posee una sesión autenticada activa.</li>
            <li><code class="text-amber-400 font-mono">CheckAge</code>: Valida que <code class="font-mono">Auth::user()->age &ge; 18</code>. Si un menor intenta acceder, es expulsado inmediatamente a su habitación con un aviso flash.</li>
        </ul>
    </div>
</div>
@endsection

