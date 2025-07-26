<x-app-layout>
    <div class="min-h-[80vh] bg-gradient-to-br from-green-50 to-slate-100 flex items-start justify-center pt-16 p-6">
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full px-6 py-5 border-l-4 border-green-500">
            <div class="flex items-start space-x-5">
                <!-- Icono de bienvenida -->
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>

                <!-- Contenido de bienvenida -->
                <div class="flex-1">
                    <h1 class="text-xl font-semibold text-gray-900 mb-3">Bienvenido, {{ $usuario->name }}</h1>
                    <p class="text-sm text-gray-700 mb-1"><strong>NIT:</strong> {{ $usuario->nit }}</p>
                    <p class="text-sm text-gray-700">
                        <strong>Tasa actual USD → GTQ:</strong> Q{{ $tasa['tasa'] }} 
                        <span class="text-gray-500">({{ $tasa['fecha'] }})</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
