@extends('layouts.resort')

@section('title', 'Bienvenido a Resort Paradiso')

@section('content')
<div class="space-y-8">
    <!-- Hero Principal -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-900 via-slate-800 to-slate-900 border border-slate-700 p-8 sm:p-12 shadow-2xl">
        <div class="max-w-3xl space-y-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-300 border border-amber-500/30">
                🌴 Zona Pública · Acceso Libre
            </span>
            <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-white">
                Bienvenido a Resort Paradiso
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                El complejo vacacional digital más exclusivo. Pasea por nuestras instalaciones públicas o descubre nuestras áreas restringidas: suites privadas para clientes, el casino exclusivo para adultos y la oficina de dirección ejecutiva.
            </p>
            <div class="pt-2 flex flex-wrap gap-3">
                <a href="{{ route('panel') }}" class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm transition shadow-lg shadow-indigo-600/30">
                    Ir a mi Habitación (Panel) →
                </a>
                <a href="{{ route('casino') }}" class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-500 text-white font-semibold text-sm transition shadow-lg shadow-amber-600/30">
                    Probar acceso al Casino (+18) →
                </a>
                <a href="{{ route('admin') }}" class="px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-semibold text-sm transition shadow-lg shadow-rose-600/30">
                    Oficina de Dirección →
                </a>
            </div>
        </div>
    </div>

    <!-- Secciones del Resort & Middleware Matrix -->
    <div>
        <h2 class="text-xl font-bold text-slate-100 mb-4 flex items-center space-x-2">
            <span>🛡️ Mapa de Accesos y Porteros Virtuales (Middlewares)</span>
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Tarjeta 1: Habitación -->
            <div class="bg-slate-800/60 border border-slate-700 rounded-xl p-6 hover:border-indigo-500 transition shadow-lg flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="w-12 h-12 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-2xl">
                        🛏️
                    </div>
                    <h3 class="text-lg font-bold text-white">Habitación Privada</h3>
                    <p class="text-xs text-indigo-400 font-mono">Ruta: /panel</p>
                    <p class="text-slate-400 text-sm">
                        Espacio personal para los clientes alojados. Requiere estar registrado e identificado en el sistema.
                    </p>
                    <div class="pt-2">
                        <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-md bg-indigo-900/60 text-indigo-200 border border-indigo-700">
                            Portero: CheckAuth
                        </span>
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-700/60">
                    <a href="{{ route('panel') }}" class="text-indigo-400 hover:text-indigo-300 text-sm font-semibold flex items-center space-x-1">
                        <span>Entrar a la habitación</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Tarjeta 2: Casino -->
            <div class="bg-slate-800/60 border border-slate-700 rounded-xl p-6 hover:border-amber-500 transition shadow-lg flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="w-12 h-12 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center text-2xl">
                        🎰
                    </div>
                    <h3 class="text-lg font-bold text-white">Casino Real Paradiso</h3>
                    <p class="text-xs text-amber-400 font-mono">Ruta: /casino</p>
                    <p class="text-slate-400 text-sm">
                        Sala de ocio y apuestas de alta gama. Exclusiva para mayores de edad (18 años o más). Los menores son rebotados a su habitación.
                    </p>
                    <div class="pt-2 flex flex-wrap gap-1">
                        <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-md bg-indigo-900/60 text-indigo-200 border border-indigo-700">
                            CheckAuth
                        </span>
                        <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-md bg-amber-900/60 text-amber-200 border border-amber-700">
                            CheckAge (&ge; 18)
                        </span>
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-700/60">
                    <a href="{{ route('casino') }}" class="text-amber-400 hover:text-amber-300 text-sm font-semibold flex items-center space-x-1">
                        <span>Entrar al casino</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Tarjeta 3: Dirección -->
            <div class="bg-slate-800/60 border border-slate-700 rounded-xl p-6 hover:border-rose-500 transition shadow-lg flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="w-12 h-12 rounded-lg bg-rose-500/20 text-rose-400 flex items-center justify-center text-2xl">
                        👑
                    </div>
                    <h3 class="text-lg font-bold text-white">Oficina de Dirección</h3>
                    <p class="text-xs text-rose-400 font-mono">Ruta: /admin</p>
                    <p class="text-slate-400 text-sm">
                        Centro de administración del resort. Zona restringida con acceso reservado a personal con rol de administrador (`is_admin = true`).
                    </p>
                    <div class="pt-2 flex flex-wrap gap-1">
                        <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-md bg-indigo-900/60 text-indigo-200 border border-indigo-700">
                            CheckAuth
                        </span>
                        <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-md bg-rose-900/60 text-rose-200 border border-rose-700">
                            CheckAdmin (is_admin)
                        </span>
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-700/60">
                    <a href="{{ route('admin') }}" class="text-rose-400 hover:text-rose-300 text-sm font-semibold flex items-center space-x-1">
                        <span>Entrar a dirección</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

