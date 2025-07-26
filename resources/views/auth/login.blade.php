<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-500 via-purple-500 to-purple-600 flex items-center justify-center p-6">
        
        <!-- Link para regresar -->
        <div class="absolute top-8 left-8">
            <a href="{{ url('/') }}" 
               class="flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-lg text-white border border-white/30 rounded-lg font-medium hover:bg-white/30 transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver
            </a>
        </div>

        <div class="w-full max-w-md">
            <div class="bg-white/95 backdrop-blur-xl rounded-2xl p-8 shadow-2xl">
                
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-bold">SAT</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Iniciar Sesión</h2>
                    <p class="text-gray-600">Accede a tu cuenta del Sistema SAT</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Correo Electrónico')" class="text-sm font-semibold text-gray-700 mb-2" />
                        <x-text-input id="email" 
                                     type="email" 
                                     name="email" 
                                     :value="old('email')" 
                                     required 
                                     autofocus 
                                     autocomplete="username"
                                     class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 bg-gray-50 focus:bg-white" 
                                     placeholder="tu@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Contraseña')" class="text-sm font-semibold text-gray-700 mb-2" />
                        <x-text-input id="password" 
                                     type="password" 
                                     name="password" 
                                     required 
                                     autocomplete="current-password"
                                     class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 bg-gray-50 focus:bg-white" 
                                     placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center">
                            <input id="remember_me" 
                                   type="checkbox" 
                                   name="remember"
                                   class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" 
                               class="text-sm text-blue-600 hover:text-blue-500 font-medium">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <x-primary-button class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 px-4 rounded-xl font-semibold hover:-translate-y-1 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 justify-center">
                        {{ __('Log in') }}
                    </x-primary-button>

                    <!-- Register Link -->
                    <div class="text-center pt-4">
                        <p class="text-gray-600">
                            ¿No tienes cuenta? 
                            <a href="{{ route('register') }}" 
                               class="text-blue-600 hover:text-blue-500 font-semibold">
                                Regístrate aquí
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Footer Info -->
            <div class="text-center mt-6">
                <p class="text-white/80 text-sm">
                    Sistema de Verificación Tributaria con Microservicios
                </p>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
        }
        
        /* Override guest layout default styles */
        .min-h-screen {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6, #a855f7) !important;
        }
    </style>
</x-guest-layout>