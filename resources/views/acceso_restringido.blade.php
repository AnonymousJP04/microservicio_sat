<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50 flex items-center justify-center p-6">
        <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl max-w-lg w-full p-8 border-l-4 
            @if($tipo === 'omisiones_pendientes') border-red-500 
            @elseif($tipo === 'no_encontrado') border-yellow-500 
            @else border-orange-500 @endif">
            
            <div class="text-center mb-8">
                <!-- Logo SAT -->
                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-orange-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <span class="text-white text-2xl font-bold">SAT</span>
                </div>
                
                <!-- Icono dinámico grande -->
                <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6
                    @if($tipo === 'omisiones_pendientes') bg-red-100 
                    @elseif($tipo === 'no_encontrado') bg-yellow-100 
                    @else bg-orange-100 @endif">
                    
                    @if($tipo === 'omisiones_pendientes')
                        <!-- Icono de prohibido -->
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                    @elseif($tipo === 'no_encontrado')
                        <!-- Icono de búsqueda -->
                        <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    @else
                        <!-- Icono de advertencia -->
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    @endif
                </div>

                <!-- Título principal -->
                <h1 class="text-2xl font-bold text-gray-900 mb-3">{{ $titulo ?? 'Acceso Restringido' }}</h1>
            </div>

            <!-- Mensaje principal -->
            <div class="text-center mb-8">
                <p class="text-gray-700 leading-relaxed text-lg">{{ $mensaje }}</p>
            </div>
            
            <!-- Información del usuario -->
            @if(isset($usuario))
                <div class="bg-gray-50 p-4 rounded-xl mb-6 border border-gray-200">
                    <h3 class="font-semibold text-gray-800 mb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Información del Usuario
                    </h3>
                    <div class="grid grid-cols-1 gap-2 text-sm text-gray-600">
                        <p><strong>Nombre:</strong> {{ $usuario->name }}</p>
                        <p><strong>NIT:</strong> {{ $usuario->nit }}</p>
                        <p><strong>Email:</strong> {{ $usuario->email }}</p>
                    </div>
                </div>
            @endif

            <!-- Mensajes específicos por tipo -->
            @if($tipo === 'omisiones_pendientes')
                <div class="bg-red-50 border border-red-200 p-4 rounded-xl mb-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="text-2xl">💡</span>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-red-800 mb-2">¿Qué puedes hacer?</h3>
                            <ul class="text-sm text-red-700 space-y-1">
                                <li>• Contacta a la SAT para regularizar tu situación</li>
                                <li>• Revisa tus declaraciones pendientes</li>
                                <li>• Verifica tus pagos tributarios</li>
                                <li>• Una vez resuelto, podrás acceder al sistema</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @elseif($tipo === 'no_encontrado')
                <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-xl mb-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="text-2xl">ℹ️</span>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-yellow-800 mb-2">Información</h3>
                            <p class="text-sm text-yellow-700">
                                Tu NIT no se encuentra en nuestros registros del SAT. 
                                Contacta al administrador del sistema para verificar tu información.
                            </p>
                        </div>
                    </div>
                </div>
            @elseif($tipo === 'error_sistema' && isset($error_detalle))
                <div class="bg-gray-50 border border-gray-200 p-4 rounded-xl mb-6">
                    <h3 class="text-sm font-semibold text-gray-800 mb-2">Detalle Técnico</h3>
                    <p class="text-sm text-gray-600 font-mono bg-gray-100 p-2 rounded">
                        {{ $error_detalle }}
                    </p>
                </div>
            @endif

            <!-- Botones de acción -->
            <div class="flex flex-col gap-3">
                <!-- Botón principal: Cerrar sesión -->
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-red-500 to-orange-600 text-white py-3 px-4 rounded-xl font-semibold hover:-translate-y-1 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Cerrar Sesión
                    </button>
                </form>

                <!-- Botón secundario: Contactar soporte -->
                @if($tipo === 'omisiones_pendientes')
                    <a href="tel:1551" 
                       class="w-full bg-white border-2 border-red-500 text-red-600 py-3 px-4 rounded-xl font-semibold text-center hover:bg-red-500 hover:text-white hover:-translate-y-1 transition-all duration-300">
                        📞 Contactar SAT (1551)
                    </a>
                @else
                    <a href="mailto:soporte@sat.gob.gt" 
                       class="w-full bg-white border-2 border-gray-400 text-gray-600 py-3 px-4 rounded-xl font-semibold text-center hover:bg-gray-400 hover:text-white hover:-translate-y-1 transition-all duration-300">
                        📧 Contactar Soporte
                    </a>
                @endif
            </div>

            <!-- Footer -->
            <div class="text-center mt-8 pt-6 border-t border-gray-200">
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