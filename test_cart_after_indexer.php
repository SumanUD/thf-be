<?php

use Webkul\Checkout\Facades\Cart;
use Webkul\Product\Repositories\ProductRepository;

echo "Testing add to cart after running indexer...\n\n";

$productRepo = app(ProductRepository::class);
$product = $productRepo->find(15);

echo "Product: {$product->name}\n";
echo "Price: {$product->price}\n\n";

// Check inventory index
echo "Checking inventory index...\n";
$inventoryIndex = $product->inventory_indices()
    ->where('channel_id', core()->getCurrentChannel()->id)
    ->first();

if ($inventoryIndex) {
    echo "  ✓ Inventory index exists! qty = {$inventoryIndex->qty}\n\n";
} else {
    echo "  ✗ NO inventory index!\n\n";
}

// Try adding to cart
echo "Attempting to add product to cart...\n";
try {
    $cart = Cart::addProduct($product, [
        'product_id' => 15,
        'quantity' => 1,
    ]);

    echo "✓ SUCCESS! Product added to cart\n";
    echo "Cart ID: {$cart->id}\n";
    echo "Items count: {$cart->items_count}\n";
    echo "Items qty: {$cart->items_qty}\n\n";

    // Verify cart items
    echo "Checking cart_items table...\n";
    $cartItems = \DB::table('cart_items')
        ->where('cart_id', $cart->id)
        ->get();

    if ($cartItems->count() > 0) {
        echo "✓ Cart items found in database: {$cartItems->count()} items\n";
        foreach ($cartItems as $item) {
            echo "  - Item ID: {$item->id}, Product: {$item->name}, Qty: {$item->quantity}\n";
        }
    } else {
        echo "✗ NO cart items in database!\n";
    }

} catch (\Exception $e) {
    echo "✗ FAILED!\n";
    echo "Error: " . $e->getMessage() . "\n";
}
