@extends('layouts.resort')

@section('title', 'Oficina de Dirección - Administración')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <!-- Encabezado de Dirección -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-rose-950 via-slate-900 to-rose-900 border border-rose-600/50 p-8 shadow-2xl">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-3">
                <div class="flex items-center space-x-2">
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-rose-500/20 text-rose-300 border border-rose-500/40">
                        👑 Área Restringida · Alta Dirección
                    </span>
                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-500/40">
                        ✓ CheckAdmin Superado
                    </span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                    🏛️ Oficina de Dirección del Resort
                </h1>
                <p class="text-rose-200/80 text-sm sm:text-base leading-relaxed max-w-2xl">
                    Bienvenido, Administrador <span class="font-bold text-white">{{ Auth::user()->name }}</span>. Solo el personal con <code class="text-rose-300 font-mono">is_admin = true</code> puede superar el middleware <code class="text-rose-300 font-mono">CheckAdmin</code> y acceder a este despacho.
                </p>
            </div>
            <div class="bg-rose-950/80 border border-rose-700/60 rounded-xl p-4 text-center min-w-[170px] shadow-lg">
                <span class="text-xs text-rose-300 block font-semibold uppercase tracking-wider">Permiso de Acceso</span>
                <span class="text-xl font-bold text-white block mt-1">Nivel Ejecutivo</span>
                <span class="text-xs text-emerald-400 font-mono mt-0.5 inline-block">is_admin: true</span>
            </div>
        </div>
    </div>

    <!-- Métricas del Resort -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        @php
            $totalUsers = \App\Models\User::count();
            $adultUsers = \App\Models\User::where('age', '>=', 18)->count();
            $adminUsers = \App\Models\User::where('is_admin', true)->count();
        @endphp
        <div class="bg-slate-800/60 border border-slate-700 rounded-xl p-5 shadow-lg">
            <span class="text-xs text-slate-400 uppercase font-semibold">Total Huéspedes Registrados</span>
            <div class="text-3xl font-extrabold text-white mt-1">{{ $totalUsers }}</div>
            <span class="text-xs text-slate-500">En base de datos SQLite</span>
        </div>
        <div class="bg-slate-800/60 border border-slate-700 rounded-xl p-5 shadow-lg">
            <span class="text-xs text-amber-400 uppercase font-semibold">Aptos para el Casino (+18)</span>
            <div class="text-3xl font-extrabold text-amber-400 mt-1">{{ $adultUsers }}</div>
            <span class="text-xs text-slate-500">Verificados por CheckAge</span>
        </div>
        <div class="bg-slate-800/60 border border-slate-700 rounded-xl p-5 shadow-lg">
            <span class="text-xs text-rose-400 uppercase font-semibold">Cuentas con Rol Administrador</span>
            <div class="text-3xl font-extrabold text-rose-400 mt-1">{{ $adminUsers }}</div>
            <span class="text-xs text-slate-500">Verificados por CheckAdmin</span>
        </div>
    </div>

    <!-- Lista de Huéspedes Registrados en el Sistema -->
    <div class="bg-slate-800/60 border border-slate-700 rounded-xl shadow-lg overflow-hidden">
        <div class="p-5 border-b border-slate-700 flex items-center justify-between">
            <h2 class="text-base font-bold text-white flex items-center space-x-2">
                <span>👥 Registro Central de Huéspedes</span>
            </h2>
            <span class="text-xs text-slate-400 font-mono">Tabla: users</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-900/60 text-xs text-slate-400 uppercase tracking-wider font-semibold">
                    <tr>
                        <th class="px-5 py-3">ID</th>
                        <th class="px-5 py-3">Nombre</th>
                        <th class="px-5 py-3">Email</th>
                        <th class="px-5 py-3">Edad</th>
                        <th class="px-5 py-3">Acceso Casino (&ge;18)</th>
                        <th class="px-5 py-3">Rol Administrador</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/60">
                    @foreach(\App\Models\User::orderBy('id')->get() as $u)
                        <tr class="hover:bg-slate-700/30 transition">
                            <td class="px-5 py-3 font-mono text-xs text-slate-400">#{{ $u->id }}</td>
                            <td class="px-5 py-3 font-semibold text-white">{{ $u->name }}</td>
                            <td class="px-5 py-3 font-mono text-xs text-slate-300">{{ $u->email }}</td>
                            <td class="px-5 py-3 font-semibold">{{ $u->age }} años</td>
                            <td class="px-5 py-3">
                                @if($u->age >= 18)
                                    <span class="px-2 py-0.5 rounded text-xs bg-emerald-900/60 text-emerald-300 border border-emerald-700 font-semibold">
                                        Autorizado
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-xs bg-amber-900/60 text-amber-300 border border-amber-700 font-semibold">
                                        Menor de edad
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                @if($u->is_admin)
                                    <span class="px-2 py-0.5 rounded text-xs bg-rose-900/60 text-rose-300 border border-rose-700 font-semibold">
                                        Administrador
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-xs bg-slate-700 text-slate-300 font-semibold">
                                        Cliente Normal
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

