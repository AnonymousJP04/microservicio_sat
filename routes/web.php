<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
});

// Redirige a /verificar-usuario al iniciar sesión
Route::get('/dashboard', function () {
    return redirect('/verificar-usuario');
})->middleware(['auth', 'verified'])->name('dashboard');

// Ruta protegida para verificar al usuario en microservicios
Route::middleware(['auth'])->get('/verificar-usuario', function () {
    $usuario = Auth::user();

    // --- CONSULTA AL MICROSERVICIO SAT ---
    try {
        $respuestaSat = Http::get('http://127.0.0.1:5003/verificar_sat', [
            'nit' => $usuario->nit,
        ]);

        if ($respuestaSat->status() === 404) {
            return view('acceso_restringido', [
                'titulo' => 'Usuario no registrado en SAT',
                'mensaje' => 'Su NIT no se encuentra registrado en el sistema del SAT.',
                'tipo' => 'no_encontrado'
            ]);
        }

        if ($respuestaSat->failed()) {
            return view('acceso_restringido', [
                'titulo' => 'Error de conexión SAT',
                'mensaje' => 'No se pudo verificar su estado tributario. Intente más tarde.',
                'tipo' => 'error_conexion'
            ]);
        }

        $dataSat = $respuestaSat->json();

        // Verificar si tiene omisiones (usando tu estructura)
        if (isset($dataSat['tiene_omisiones']) && $dataSat['tiene_omisiones']) {
            return view('acceso_restringido', [
                'titulo' => 'Acceso Denegado - Omisiones Tributarias',
                'mensaje' => 'Usted tiene omisiones o multas tributarias pendientes. Debe regularizar su situación con la SAT antes de acceder al sistema.',
                'tipo' => 'omisiones_pendientes',
                'usuario' => $usuario
            ]);
        }

    } catch (\Exception $e) {
        return view('acceso_restringido', [
            'titulo' => 'Error del Sistema',
            'mensaje' => 'No se pudo conectar al microservicio del SAT. Contacte al administrador.',
            'tipo' => 'error_sistema',
            'error_detalle' => $e->getMessage()
        ]);
    }

    // --- CONSULTA AL MICROSERVICIO DE TASA DE CAMBIO ---
    try {
        // Usando el microservicio de tasa de cambio del Banguat
        $respuestaTasa = Http::get('http://127.0.0.1:5001/tipo_cambio_dia');

        if ($respuestaTasa->successful()) {
            $dataTasa = $respuestaTasa->json();
            $tasa = [
                'fecha' => $dataTasa['Fecha'] ?? 'N/D',
                'referencia' => $dataTasa['Referencia'] ?? 'N/D',
                'disponible' => true
            ];
        } else {
            $tasa = [
                'fecha' => 'N/D',
                'referencia' => 'N/D',
                'disponible' => false
            ];
        }
    } catch (\Exception $e) {
        $tasa = [
            'fecha' => 'N/D',
            'referencia' => 'N/D',
            'disponible' => false
        ];
    }

    // --- MOSTRAR VISTA DE BIENVENIDA ---
    return view('acceso_permitido', [
        'usuario' => $usuario,
        'tasa_cambio' => $tasa,
        'estado_sat' => 'al_dia'
    ]);
});

// Rutas de perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Autenticación (Laravel Breeze)
require __DIR__.'/auth.php';