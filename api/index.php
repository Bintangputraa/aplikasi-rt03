<?php

try {
    // Meneruskan request ke sistem utama Laravel
    require __DIR__ . '/../public/index.php';
    
} catch (\Throwable $e) {
    // Memotong sistem error bawaan Laravel dan menampilkannya secara paksa
    echo "<div style='font-family: Arial, sans-serif; padding: 30px; line-height: 1.6; max-width: 900px; margin: 0 auto;'>";
    echo "<h2 style='color: #d32f2f; border-bottom: 2px solid #d32f2f; padding-bottom: 10px;'>🚨 ERROR ASLI DITEMUKAN 🚨</h2>";
    
    echo "<div style='background-color: #ffebee; color: #b71c1c; padding: 20px; border-radius: 8px; margin: 20px 0;'>";
    echo "<h3 style='margin-top: 0;'>Pesan Error:</h3>";
    echo "<p style='font-size: 18px; font-family: monospace; font-weight: bold; word-break: break-all;'>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "</div>";
    
    echo "<div style='background-color: #f5f5f5; padding: 20px; border-radius: 8px; margin-bottom: 20px;'>";
    echo "<p style='margin: 0 0 10px 0;'><b>📍 Lokasi File:</b><br>" . htmlspecialchars($e->getFile()) . "</p>";
    echo "<p style='margin: 0;'><b>📌 Baris ke:</b> " . $e->getLine() . "</p>";
    echo "</div>";
    
    echo "<h3>Stack Trace (Jejak Error):</h3>";
    echo "<pre style='background-color: #263238; color: #00e676; padding: 20px; border-radius: 8px; overflow-x: auto; font-size: 13px;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    echo "</div>";
}