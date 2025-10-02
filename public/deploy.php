<?php
// deploy.php

// Simple secret token untuk keamanan
$secret = 'gac0anLevel8';  // ganti dengan string random panjang

// Ambil header GitHub
$headers = getallheaders();
$github_signature = $headers['X-Hub-Signature'] ?? '';

$payload = file_get_contents('php://input');

// Verifikasi signature (optional tapi lebih aman)
if (!hash_equals('sha1=' . hash_hmac('sha1', $payload, $secret), $github_signature)) {
    http_response_code(403);
    echo "Unauthorized";
    exit;
}

// Eksekusi deploy
exec('cd ' . escapeshellarg(__DIR__) . ' && git fetch --all && git reset --hard origin/master && composer install --no-dev --optimize-autoloader && php spark migrate --all && chmod -R 775 writable 2>&1', $output, $return_var);

if ($return_var === 0) {
    echo "Deploy success:\n" . implode("\n", $output);
} else {
    http_response_code(500);
    echo "Deploy failed:\n" . implode("\n", $output);
}
