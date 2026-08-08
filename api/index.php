<?php

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // Buat struktur folder sementara di /tmp khusus untuk Vercel
    $compiledDirs = [
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/sessions',
        '/tmp/bootstrap/cache'
    ];

    foreach ($compiledDirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

    // Paksa Laravel menggunakan folder /tmp agar tidak error Read-Only
    $app->useStoragePath('/tmp/storage');
    $app->useBootstrapPath('/tmp/bootstrap');

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );

    $response->send();

    $kernel->terminate($request, $response);

} catch (\Throwable $e) {
    // MEMAKSA ERROR TERCETAK DI SATU BARIS SAJA PADA LOG VERCEL
    $pesanError = "🚨 PENYAKIT ASLI: " . $e->getMessage() . " | Di file: " . $e->getFile() . " (Baris " . $e->getLine() . ")";
    
    // Tulis ke log server Vercel
    error_log($pesanError);
    
    // Tampilkan teks biasa ke layar browser
    http_response_code(500);
    echo "<h2 style='color:red; font-family:sans-serif; text-align:center; margin-top:50px; padding: 20px;'>" . htmlspecialchars($pesanError) . "</h2>";
}