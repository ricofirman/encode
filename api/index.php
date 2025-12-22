<?php
// api/index.php
$path = __DIR__ . '/../../public/index.php';
if (file_exists($path)) {
    require $path;
} else {
    // Fallback untuk Vercel structure
    require __DIR__ . '/../public/index.php';
}