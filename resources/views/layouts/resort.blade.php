<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Resort Paradiso - Plataforma Digital')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col">

    <!-- Barra de Navegación Principal -->
    <header class="bg-slate-800/90 backdrop-blur border-b border-slate-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 text-xl font-extrabold tracking-tight text-amber-400 hover:text-amber-300 transition">
                        <span>🏝️ Resort Paradiso</span>
                    </a>
                    <span class="hidden md:inline-block px-2.5 py-0.5 text-xs rounded-full bg-slate-700 text-slate-300 border border-slate-600">Sistema de Control de Acceso</span>
                </div>

                <nav class="flex items-center space-x-1 sm:space-x-2">
                    <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        Inicio
                    </a>
                    <a href="{{ route('panel') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('panel') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        🛏️ Habitación
                    </a>
                    <a href="{{ route('casino') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('casino') ? 'bg-amber-600 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        🎰 Casino (+18)
                    </a>
                    <a href="{{ route('admin') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin') ? 'bg-rose-600 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        👑 Dirección
                    </a>
                </nav>

                <div class="flex items-center space-x-3">
                    @auth
                        <div class="hidden sm:flex flex-col text-right text-xs">
                            <span class="font-bold text-slate-200">{{ Auth::user()->name }}</span>
                            <span class="text-slate-400">
                                {{ Auth::user()->age }} años · 
                                @if(Auth::user()->is_admin)
                                    <span class="text-rose-400 font-semibold">Administrador</span>
                                @else
                                    <span class="text-emerald-400 font-semibold">Cliente</span>
                                @endif
                            </span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-xs bg-slate-700 hover:bg-slate-600 text-slate-200 px-3 py-2 rounded-lg font-medium transition">
                                Salir
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-xs bg-indigo-600 hover:bg-indigo-500 text-white px-3.5 py-2 rounded-lg font-semibold transition">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="text-xs bg-slate-700 hover:bg-slate-600 text-slate-200 px-3.5 py-2 rounded-lg font-medium transition hidden sm:inline-block">
                            Registrarse
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Barra de Pruebas Rápidas de Perfiles (Simulador de Acceso) -->
    <div class="bg-slate-950/80 border-b border-slate-800 py-2 px-4 text-xs">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
            <span class="text-slate-400 font-mono">⚡ Modo Simulador: cambia de usuario al instante para probar los middlewares:</span>
            <div class="flex items-center flex-wrap gap-2">
                <form action="{{ route('login.simulate') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="email" value="admin@resort.com">
                    <button type="submit" class="px-2.5 py-1 rounded bg-rose-950 border border-rose-700 text-rose-300 hover:bg-rose-900 transition font-medium">
                        👑 Admin (42 años)
                    </button>
                </form>
                <form action="{{ route('login.simulate') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="email" value="adulto@resort.com">
                    <button type="submit" class="px-2.5 py-1 rounded bg-emerald-950 border border-emerald-700 text-emerald-300 hover:bg-emerald-900 transition font-medium">
                        🧑 Adulto (26 años)
                    </button>
                </form>
                <form action="{{ route('login.simulate') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="email" value="menor@resort.com">
                    <button type="submit" class="px-2.5 py-1 rounded bg-amber-950 border border-amber-700 text-amber-300 hover:bg-amber-900 transition font-medium">
                        🧒 Menor (16 años)
                    </button>
                </form>
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-2.5 py-1 rounded bg-slate-800 border border-slate-600 text-slate-300 hover:bg-slate-700 transition">
                            ❌ Desconectar
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>

    <!-- Alertas Flash -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
        @if (session('error'))
            <div class="bg-rose-500/10 border-l-4 border-rose-500 text-rose-200 p-4 rounded-r-lg shadow-lg flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <span class="text-xl">⛔</span>
                    <div>
                        <p class="font-bold text-rose-300">Acceso Restringido por Middleware</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-emerald-500/10 border-l-4 border-emerald-500 text-emerald-200 p-4 rounded-r-lg shadow-lg flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <span class="text-xl">✅</span>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Contenido Principal -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Pie de página -->
    <footer class="bg-slate-950 border-t border-slate-800 py-6 text-center text-xs text-slate-500">
        <p>Resort Paradiso Digital &copy; {{ date('Y') }} — Tarea de Enrutamiento y Middlewares en Laravel</p>
    </footer>

</body>
</html>

