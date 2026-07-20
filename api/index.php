<?php
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

// Forward Vercel serverless requests to Laravel's public entrypoint
require __DIR__ . '/../public/index.php';
