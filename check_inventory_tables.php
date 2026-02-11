<?php

use Illuminate\Support\Facades\DB;

echo "Checking inventory tables...\n\n";

echo "1. product_inventories table:\n";
$inventories = DB::table('product_inventories')
    ->where('product_id', 15)
    ->get();

if ($inventories->count() > 0) {
    foreach ($inventories as $inv) {
        echo "  Product {$inv->product_id}: qty = {$inv->qty}, source_id = {$inv->inventory_source_id}\n";
    }
} else {
    echo "  ✗ NO records!\n";
}

echo "\n2. inventory_indices table:\n";
$indices = DB::table('inventory_indices')
    ->where('product_id', 15)
    ->get();

if ($indices->count() > 0) {
    foreach ($indices as $idx) {
        echo "  Product {$idx->product_id}: qty = {$idx->qty}, channel_id = {$idx->channel_id}\n";
    }
} else {
    echo "  ✗ NO records!\n";
}

echo "\n3. Channel info:\n";
$channel = core()->getCurrentChannel();
echo "  Current channel ID: {$channel->id}\n";
echo "  Current channel code: {$channel->code}\n";

echo "\n4. Running inventory indexer manually...\n";
try {
    \Artisan::call('indexer:index', ['--type' => 'inventory']);
    echo "  ✓ Indexer completed\n";
} catch (\Exception $e) {
    echo "  ✗ Error: " . $e->getMessage() . "\n";
}

echo "\n5. Checking inventory_indices again:\n";
$indices = DB::table('inventory_indices')
    ->where('product_id', 15)
    ->get();

if ($indices->count() > 0) {
    foreach ($indices as $idx) {
        echo "  Product {$idx->product_id}: qty = {$idx->qty}, channel_id = {$idx->channel_id}\n";
    }
} else {
    echo "  ✗ STILL NO records!\n";
}
