<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$routes = Route::getRoutes();

echo "=== CHECKING ALL ROUTES ===\n\n";

$expectedRoutes = [
    // Public
    'home' => 'GET /',
    'products.index' => 'GET /products',
    'products.show' => 'GET /products/{product}',
    
    // Buyer
    'buyer.orders.index' => 'GET /buyer/orders',
    'buyer.orders.show' => 'GET /buyer/orders/{order}',
    'orders.store' => 'POST /orders',
    
    // Seller
    'seller.products.index' => 'GET /seller/products',
    'seller.products.create' => 'GET /seller/products/create',
    'seller.products.store' => 'POST /seller/products',
    'seller.products.edit' => 'GET /seller/products/{product}/edit',
    'seller.products.update' => 'PUT /seller/products/{product}',
    'seller.products.destroy' => 'DELETE /seller/products/{product}',
    
    // Admin
    'admin.dashboard' => 'GET /admin/dashboard',
    'admin.orders.index' => 'GET /admin/orders',
    'admin.orders.show' => 'GET /admin/orders/{order}',
    'admin.orders.verify' => 'POST /admin/orders/{order}/verify',
    'admin.orders.update-status' => 'POST /admin/orders/{order}/update-status',
];

$missing = [];
$found = [];

foreach ($expectedRoutes as $name => $desc) {
    $route = $routes->getByName($name);
    if ($route) {
        $found[] = "✓ $name - $desc";
    } else {
        $missing[] = "✗ $name - $desc (MISSING!)";
    }
}

echo "FOUND ROUTES:\n";
foreach ($found as $item) {
    echo $item . "\n";
}

if (!empty($missing)) {
    echo "\n\nMISSING ROUTES:\n";
    foreach ($missing as $item) {
        echo $item . "\n";
    }
} else {
    echo "\n\n✅ All expected routes are registered!\n";
}
