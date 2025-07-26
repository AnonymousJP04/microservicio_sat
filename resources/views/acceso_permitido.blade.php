<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-blue-50 flex items-center justify-center p-6">
        <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl max-w-2xl w-full p-8 border-l-4 border-green-500">
            
            <!-- Header con Logo y Estado -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="text-white text-3xl font-bold">SAT</span>
                </div>
                
                <!-- Badge de estado -->
                <div class="inline-flex items-center px-4 py-2 bg-green-100 border border-green-300 rounded-full mb-4">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="text-green-700 font-semibold text-sm">Estado Tributario: Al Día</span>
                </div>
                
                <h1 class="text-3xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent mb-2">
                    ¡Bienvenido, {{ $usuario->name }}!
                </h1>
                <p class="text-gray-600">Tu acceso al Sistema SAT ha sido autorizado</p>
            </div>

            <!-- Grid de información -->
            <div class="grid md:grid-cols-2 gap-6 mb-8">
                
                <!-- Información personal -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-200">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Información Personal
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-600">Nombre:</span>
                            <span class="text-sm text-gray-800 font-semibold">{{ $usuario->name }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-600">NIT:</span>
                            <span class="text-sm text-gray-800 font-mono bg-gray-100 px-2 py-1 rounded">{{ $usuario->nit }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-600">Email:</span>
                            <span class="text-sm text-gray-800">{{ $usuario->email }}</span>
                        </div>
                    </div>
                </div>

                <!-- Tasa de cambio -->
                <div class="bg-gradient-to-br from-emerald-50 to-green-50 p-6 rounded-xl border border-emerald-200">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                        Tasa de Cambio USD → GTQ
                    </h3>
                    
                    @if($tasa_cambio['disponible'])
                        <div class="space-y-3">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-emerald-600 mb-1">
                                    Q{{ $tasa_cambio['referencia'] }}
                                </div>
                                <p class="text-sm text-gray-600">Por cada dólar americano</p>
                            </div>
                            <div class="bg-white/60 p-3 rounded-lg">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600">Fecha:</span>
                                    <span class="font-medium text-gray-800">{{ $tasa_cambio['fecha'] }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm mt-1">
                                    <span class="text-gray-600">Fuente:</span>
                                    <span class="font-medium text-gray-800">Banco de Guatemala</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                            <p class="text-yellow-700 font-medium">Tasa no disponible</p>
                            <p class="text-sm text-yellow-600 mt-1">Intente más tarde</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Acciones disponibles -->
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-6 rounded-xl border border-gray-200 mb-8">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    Servicios Disponibles
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-lg border border-gray-200 text-center hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-800 text-sm">Consultas</h4>
                        <p class="text-xs text-gray-600 mt-1">Verificar estado tributario</p>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg border border-gray-200 text-center hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-800 text-sm">Pagos</h4>
                        <p class="text-xs text-gray-600 mt-1">Realizar pagos en línea</p>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg border border-gray-200 text-center hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2v0a2 2 0 01-2-2v-5H8z"/>
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-800 text-sm">Reportes</h4>
                        <p class="text-xs text-gray-600 mt-1">Generar certificaciones</p>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl font-semibold hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                    Acceder al Panel Principal
                </button>
                
                <a href="{{ route('profile.edit') }}" 
                   class="px-6 py-3 border-2 border-green-500 text-green-600 rounded-xl font-semibold text-center hover:bg-green-500 hover:text-white hover:-translate-y-1 transition-all duration-300">
                    Editar Perfil
                </a>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-600 mb-2">
                    Última verificación: {{ now()->format('d/m/Y H:i:s') }}
                </p>
                <p class="text-xs text-gray-500">
                    Sistema de Verificación Tributaria • 
                    <span class="font-semibold">Superintendencia de Administración Tributaria</span>
                </p>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
        }
    </style>
</x-app-layout>