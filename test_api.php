<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

// Create a request to the API endpoint
$request = \Illuminate\Http\Request::create('/api/products?category_id=2', 'GET');
$request->headers->set('Accept', 'application/json');

$response = $kernel->handle($request);

echo "Status Code: " . $response->getStatusCode() . "\n";
echo "Content:\n";
echo $response->getContent() . "\n";

$kernel->terminate($request, $response);
