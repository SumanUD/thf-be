<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Checking products by category:\n";
echo "==============================\n\n";

$categories = [
    2 => 'Baklava',
    3 => 'Labon',
    4 => 'Dates',
    5 => 'Mewabite',
    6 => 'Assorted'
];

foreach ($categories as $id => $name) {
    $count = DB::table('product_categories')->where('category_id', $id)->count();
    echo "$name (ID: $id): $count products\n";
}

echo "\n\nChecking if products are visible and saleable:\n";
echo "===============================================\n\n";

foreach ($categories as $id => $name) {
    $products = DB::table('product_flat')
        ->whereIn('product_id', function($query) use ($id) {
            $query->select('product_id')
                ->from('product_categories')
                ->where('category_id', $id);
        })
        ->where('status', 1)
        ->where('visible_individually', 1)
        ->get(['product_id', 'name', 'status', 'visible_individually']);
    
    echo "$name: " . $products->count() . " visible products\n";
    foreach ($products as $p) {
        echo "  - {$p->name} (ID: {$p->product_id})\n";
    }
    echo "\n";
}
