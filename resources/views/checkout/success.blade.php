<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserva Completada</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-lg w-full bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="bg-green-500 text-white p-6 text-center">
            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <h2 class="text-3xl font-bold">¡Reserva Registrada!</h2>
            <p class="mt-2 text-green-100">Solo falta el pago para confirmar tu asistencia.</p>
        </div>
        <div class="p-8">
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <p class="text-lg text-blue-800">
                    Para confirmar tu entrada, haz un Bizum de <strong>{{ $entrada->precio }}€</strong> al número:
                </p>
                <p class="text-3xl font-bold text-blue-900 text-center my-4 tracking-widest">
                    {{ $entrada->telefono_cobro }}
                </p>
                <p class="text-md text-blue-800 mt-2">
                    Indicando <strong>EXACTAMENTE</strong> en el concepto este código:
                </p>
                <div class="bg-white border-2 border-dashed border-blue-300 text-center py-3 mt-3 rounded">
                    <span class="text-2xl font-mono font-bold text-gray-800">{{ $entrada->codigo_reserva }}</span>
                </div>
            </div>

            <div class="text-sm text-gray-600 mb-6">
                <p>Una vez recibido el pago, validaremos tu entrada y recibirás un email de confirmación.</p>
                <p class="mt-2 text-red-600 font-semibold">Importante: Si no recibimos el Bizum en las próximas 24 horas, tu reserva podría ser cancelada.</p>
            </div>

            <div class="text-center">
                <a href="{{ url('/') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Volver a la página principal</a>
            </div>
        </div>
    </div>
</body>
</html>
