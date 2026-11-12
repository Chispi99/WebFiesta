@extends('layouts.resort')

@section('title', 'Registro de Huésped - Resort Paradiso')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 sm:p-8">
            <div class="text-center mb-6">
                <span class="inline-block p-3 rounded-2xl bg-emerald-500/20 text-emerald-400 text-3xl mb-2">
                    📝
                </span>
                <h1 class="text-2xl font-black text-white">Registro de Huésped en el Resort</h1>
                <p class="text-slate-400 text-sm mt-1">
                    Crea tu cuenta de huésped para obtener tu llave digital y acceder a las instalaciones.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-rose-500/10 border border-rose-500/40 text-rose-300 text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>⚠ {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">
                        Nombre Completo
                    </label>
                    <input type="text" name="name" id="name" required value="{{ old('name') }}"
                           class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500 transition"
                           placeholder="Ej. Laura Gómez">
                </div>

                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">
                        Correo Electrónico
                    </label>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}"
                           class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500 transition"
                           placeholder="laura@ejemplo.com">
                </div>

                <div>
                    <label for="age" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">
                        Edad (Años)
                    </label>
                    <input type="number" name="age" id="age" required min="1" max="120" value="{{ old('age', 22) }}"
                           class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500 transition"
                           placeholder="Ej. 25">
                    <p class="text-[11px] text-slate-400 mt-1">La edad determina el acceso a áreas restringidas como el Casino (+18).</p>
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">
                        Contraseña
                    </label>
                    <input type="password" name="password" id="password" required
                           class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3.5 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500 transition"
                           placeholder="Mínimo 6 caracteres">
                </div>

                <div class="flex items-center space-x-2 pt-1">
                    <input type="checkbox" name="is_admin" id="is_admin" value="1"
                           class="rounded bg-slate-900 border-slate-700 text-rose-600 focus:ring-0">
                    <label for="is_admin" class="text-xs text-slate-300">
                        Registrar como personal de Administración (<code class="text-rose-400">is_admin = true</code>)
                    </label>
                </div>

                <button type="submit"
                        class="w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-lg text-sm transition shadow-lg shadow-emerald-600/30">
                    Completar Registro
                </button>
            </form>

            <div class="mt-6 text-center text-xs text-slate-400">
                ¿Ya tienes una cuenta registrada?
                <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold ml-1">
                    Inicia sesión aquí
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

