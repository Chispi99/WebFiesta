@extends('layouts.resort')

@section('title', 'Iniciar Sesión - Resort Paradiso')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 sm:p-8">
            <div class="text-center mb-6">
                <span class="inline-block p-3 rounded-2xl bg-indigo-500/20 text-indigo-400 text-3xl mb-2">
                    🔑
                </span>
                <h1 class="text-2xl font-black text-white">Inicio de Sesión en el Resort</h1>
                <p class="text-slate-400 text-sm mt-1">
                    Introduce tus credenciales para identificarte ante los porteros del resort y acceder a las salas.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-rose-500/10 border border-rose-500/40 text-rose-300 text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>⚠ {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Formulario de Login -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">
                        Correo Electrónico
                    </label>
                    <input type="email" name="email" id="email" required
                           value="{{ old('email', 'adulto@resort.com') }}"
                           class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500 transition"
                           placeholder="usuario@resort.com">
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">
                        Contraseña
                    </label>
                    <input type="password" name="password" id="password" required
                           value="adulto123"
                           class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500 transition"
                           placeholder="••••••••">
                </div>

                <button type="submit"
                        class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg text-sm transition shadow-lg shadow-indigo-600/30">
                    Entrar al Complejo
                </button>
            </form>

            <!-- Acceso Rápido de Prueba -->
            <div class="mt-6 pt-6 border-t border-slate-700/60">
                <p class="text-xs font-semibold text-slate-400 text-center mb-3 uppercase tracking-wider">
                    ⚡ Autologin de Prueba (Usuarios Semilla)
                </p>
                <div class="space-y-2">
                    <form action="{{ route('login.simulate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="admin@resort.com">
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-lg bg-slate-900/80 hover:bg-slate-900 border border-rose-900/60 text-xs flex items-center justify-between transition">
                            <span class="font-medium text-rose-300">👑 Director General (Admin)</span>
                            <span class="text-slate-500 font-mono">42 años · is_admin: true</span>
                        </button>
                    </form>
                    <form action="{{ route('login.simulate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="adulto@resort.com">
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-lg bg-slate-900/80 hover:bg-slate-900 border border-emerald-900/60 text-xs flex items-center justify-between transition">
                            <span class="font-medium text-emerald-300">🧑 Carlos López (Adulto)</span>
                            <span class="text-slate-500 font-mono">26 años · is_admin: false</span>
                        </button>
                    </form>
                    <form action="{{ route('login.simulate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="menor@resort.com">
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-lg bg-slate-900/80 hover:bg-slate-900 border border-amber-900/60 text-xs flex items-center justify-between transition">
                            <span class="font-medium text-amber-300">🧒 Mateo Fernández (Menor)</span>
                            <span class="text-slate-500 font-mono">16 años · is_admin: false</span>
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-6 text-center text-xs text-slate-400">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold ml-1">
                    Regístrate aquí
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

