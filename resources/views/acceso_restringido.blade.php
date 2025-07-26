<x-app-layout>
    <!-- Estilo limpio y centrado -->
    <div class="min-h-[80vh] bg-gradient-to-br from-red-50 to-slate-100 flex items-start justify-center pt-16 p-6">
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full px-6 py-5 border-l-4 
            @if($tipo === 'omisiones_pendientes') border-red-500 
            @elseif($tipo === 'no_encontrado') border-yellow-500 
            @else border-orange-500 @endif">
            
            <div class="flex items-start space-x-5">
                <!-- Icono dinámico -->
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center
                        @if($tipo === 'omisiones_pendientes') bg-red-100 
                        @elseif($tipo === 'no_encontrado') bg-yellow-100 
                        @else bg-orange-100 @endif">
                        
                        @if($tipo === 'omisiones_pendientes')
                            <!-- Icono de prohibido -->
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"/>
                            </svg>
                        @elseif($tipo === 'no_encontrado')
                            <!-- Icono de búsqueda -->
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        @else
                            <!-- Icono de advertencia -->
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        @endif
                    </div>
                </div>

                <!-- Contenido -->
                <div class="flex-1">
                    <h1 class="text-lg font-semibold text-gray-900 mb-3">{{ $titulo ?? 'Acceso Restringido' }}</h1>
                    <p class="text-sm text-gray-700 leading-relaxed mb-4">{{ $mensaje }}</p>
                    
                    @if(isset($usuario))
                        <div class="bg-gray-50 p-3 rounded-lg text-xs text-gray-600">
                            <p><strong>Usuario:</strong> {{ $usuario->name }}</p>
                            <p><strong>NIT:</strong> {{ $usuario->nit }}</p>
                        </div>
                    @endif

                    @if($tipo === 'omisiones_pendientes')
                        <div class="mt-4 p-3 bg-red-50 rounded-lg">
                            <p class="text-xs text-red-700">
                                💡 <strong>¿Qué hacer?</strong><br>
                                Contacte a la SAT para regularizar su situación tributaria.
                            </p>
                        </div>
                    @elseif($tipo === 'error_sistema' && isset($error_detalle))
                        <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs text-gray-600">
                                <strong>Detalle técnico:</strong> {{ $error_detalle }}
                            </p>
                        </div>
                    @endif

                    <!-- Botón para volver -->
                    <div class="mt-6">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>