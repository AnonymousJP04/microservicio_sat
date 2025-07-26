<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema SAT - Microservicios</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            }
        </style>
    </head>
    <body class="min-h-screen bg-gradient-to-br from-blue-500 via-purple-500 to-purple-600 flex items-center justify-center">
        
        @if (Route::has('login'))
            <div class="absolute top-8 right-8 flex gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" 
                       class="px-6 py-3 bg-white/20 backdrop-blur-lg text-white border border-white/30 rounded-lg font-medium hover:bg-white/30 hover:-translate-y-1 transition-all duration-300">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="px-6 py-3 bg-white/20 backdrop-blur-lg text-white border border-white/30 rounded-lg font-medium hover:bg-white/30 hover:-translate-y-1 transition-all duration-300">
                        Iniciar Sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="px-6 py-3 bg-white text-blue-600 rounded-lg font-medium hover:bg-gray-50 hover:-translate-y-1 transition-all duration-300">
                            Registrarse
                        </a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="max-w-4xl mx-auto p-8">
            <div class="bg-white/95 backdrop-blur-xl rounded-3xl p-12 shadow-2xl text-center">
                
                <!-- Logo -->
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-8">
                    <span class="text-white text-3xl font-bold">SAT</span>
                </div>
                
                <!-- Título -->
                <h1 class="text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-6">
                    Sistema SAT
                </h1>
                
                <!-- Subtítulo -->
                <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto leading-relaxed">
                    Plataforma de verificación tributaria con arquitectura de microservicios. 
                    Acceso seguro y verificación en tiempo real con el SAT.
                </p>

                <!-- Características -->
                <div class="grid md:grid-cols-3 gap-8 mb-12">
                    <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-2xl">🔐</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Verificación SAT</h3>
                        <p class="text-gray-600 text-sm">Consulta automática de omisiones y multas tributarias en tiempo real</p>
                    </div>
                    
                    <div class="bg-purple-50 p-6 rounded-xl border border-purple-100">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-2xl">💱</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Tasa de Cambio</h3>
                        <p class="text-gray-600 text-sm">Información actualizada del tipo de cambio del Banco de Guatemala</p>
                    </div>
                    
                    <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <span class="text-white text-2xl">⚡</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Microservicios</h3>
                        <p class="text-gray-600 text-sm">Arquitectura moderna y escalable con servicios independientes</p>
                    </div>
                </div>

                <!-- Botones de acción -->
                @guest
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('register') }}" 
                           class="px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-semibold hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                            Comenzar Ahora
                        </a>
                        <a href="{{ route('login') }}" 
                           class="px-8 py-4 border-2 border-blue-500 text-blue-600 rounded-xl font-semibold hover:bg-blue-500 hover:text-white hover:-translate-y-1 transition-all duration-300">
                            Ya tengo cuenta
                        </a>
                    </div>
                @else
                    <div class="flex justify-center">
                        <a href="{{ url('/dashboard') }}" 
                           class="px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-semibold hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                            Ir al Dashboard
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </body>
</html>