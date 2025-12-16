<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

try {
    // Test koneksi
    \Illuminate\Support\Facades\DB::connection()->getPdo();
    echo "✅ Database connected!\n";
    
    // Test query
    $tables = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
    echo "✅ Tables found: " . count($tables) . "\n";
    
    foreach ($tables as $table) {
        print_r($table);
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}