@extends('layouts.resort')

@section('title', 'Habitación Privada - Panel del Huésped')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <!-- Encabezado de Bienvenida -->
    <div class="bg-gradient-to-r from-indigo-950 via-slate-800 to-slate-900 border border-indigo-700/50 rounded-2xl p-6 sm:p-8 shadow-xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/20 text-indigo-300 border border-indigo-500/40">
                    🛏️ Suite Privada · Habitación #{{ 100 + Auth::user()->id }}
                </span>
                <h1 class="text-2xl sm:text-4xl font-extrabold text-white">
                    ¡Bienvenido a tu Habitación, {{ Auth::user()->name }}!
                </h1>
                <p class="text-slate-300 text-sm sm:text-base">
                    Esta es tu estancia privada dentro del Resort Paradiso. El portero virtual <code class="text-indigo-400 font-mono">CheckAuth</code> ha verificado tu identidad satisfactoriamente.
                </p>
            </div>
            <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-700 text-center min-w-[140px]">
                <div class="text-2xl font-bold text-amber-400">{{ Auth::user()->age }}</div>
                <div class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Años de Edad</div>
            </div>
        </div>
    </div>

    <!-- Ficha del Huésped y Estado de Permisos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Ficha de Datos -->
        <div class="bg-slate-800/60 border border-slate-700 rounded-xl p-6 space-y-4 shadow-lg">
            <h2 class="text-base font-bold text-white flex items-center space-x-2">
                <span>📋 Ficha del Huésped</span>
            </h2>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between py-1.5 border-b border-slate-700/50">
                    <span class="text-slate-400">Identificador (ID):</span>
                    <span class="font-mono text-slate-200">#{{ Auth::user()->id }}</span>
                </div>
                <div class="flex justify-between py-1.5 border-b border-slate-700/50">
                    <span class="text-slate-400">Nombre Completo:</span>
                    <span class="text-slate-200 font-medium">{{ Auth::user()->name }}</span>
                </div>
                <div class="flex justify-between py-1.5 border-b border-slate-700/50">
                    <span class="text-slate-400">Email Registrado:</span>
                    <span class="text-slate-200 font-mono text-xs">{{ Auth::user()->email }}</span>
                </div>
                <div class="flex justify-between py-1.5 border-b border-slate-700/50">
                    <span class="text-slate-400">Edad Acreditada:</span>
                    <span class="text-slate-200 font-semibold">{{ Auth::user()->age }} años</span>
                </div>
                <div class="flex justify-between py-1.5">
                    <span class="text-slate-400">Rango / Rol:</span>
                    <span>
                        @if(Auth::user()->is_admin)
                            <span class="px-2 py-0.5 rounded text-xs bg-rose-900/60 text-rose-300 border border-rose-700 font-semibold">
                                Administrador (Dirección)
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded text-xs bg-emerald-900/60 text-emerald-300 border border-emerald-700 font-semibold">
                                Cliente Estándar
                            </span>
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Estado de Puertas y Zonas -->
        <div class="bg-slate-800/60 border border-slate-700 rounded-xl p-6 space-y-4 shadow-lg flex flex-col justify-between">
            <div>
                <h2 class="text-base font-bold text-white flex items-center space-x-2">
                    <span>🚪 Evaluación de Porteros (Middlewares)</span>
                </h2>
                <div class="mt-4 space-y-3">
                    <!-- Casino Check -->
                    <div class="p-3 rounded-lg bg-slate-900/80 border border-slate-700 flex items-center justify-between">
                        <div class="text-xs">
                            <span class="font-bold text-slate-200 block">🎰 Acceso al Casino</span>
                            <span class="text-slate-400">Requiere edad &ge; 18 años (CheckAge)</span>
                        </div>
                        <div>
                            @if(Auth::user()->age >= 18)
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-900/60 text-emerald-300 border border-emerald-700">
                                    PERMITIDO ✓
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-900/60 text-amber-300 border border-amber-700">
                                    BLOQUEADO (&lt;18)
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Dirección Check -->
                    <div class="p-3 rounded-lg bg-slate-900/80 border border-slate-700 flex items-center justify-between">
                        <div class="text-xs">
                            <span class="font-bold text-slate-200 block">👑 Acceso a Dirección</span>
                            <span class="text-slate-400">Requiere is_admin = true (CheckAdmin)</span>
                        </div>
                        <div>
                            @if(Auth::user()->is_admin)
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-900/60 text-emerald-300 border border-emerald-700">
                                    PERMITIDO ✓
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-rose-900/60 text-rose-300 border border-rose-700">
                                    BLOQUEADO (403)
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 flex gap-2">
                <a href="{{ route('casino') }}" class="flex-1 text-center py-2 px-3 rounded-lg bg-amber-600 hover:bg-amber-500 text-white text-xs font-semibold transition">
                    Probar Casino
                </a>
                <a href="{{ route('admin') }}" class="flex-1 text-center py-2 px-3 rounded-lg bg-rose-600 hover:bg-rose-500 text-white text-xs font-semibold transition">
                    Probar Dirección
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

