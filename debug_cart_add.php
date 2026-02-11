<?php

use Illuminate\Support\Facades\DB;
use Webkul\Product\Repositories\ProductRepository;

echo "Debugging cart item creation...\n\n";

$productRepo = app(ProductRepository::class);
$product = $productRepo->find(15);

if (!$product) {
    echo "✗ Product not found!\n";
    exit;
}

echo "Product: {$product->name}\n";
echo "Type: {$product->type}\n";
echo "Price: {$product->price}\n";
echo "Weight: {$product->weight}\n\n";

// Check inventory
echo "Checking inventory...\n";
$inventory = DB::table('product_inventories')
    ->where('product_id', 15)
    ->first();

if ($inventory) {
    echo "  ✓ Inventory exists: qty = {$inventory->qty}\n\n";
} else {
    echo "  ✗ NO INVENTORY!\n\n";
}

// Try prepareForCart manually
echo "Testing prepareForCart...\n";
try {
    $typeInstance = $product->getTypeInstance();

    $cartData = $typeInstance->prepareForCart([
        'product_id' => 15,
        'quantity' => 1,
    ]);

    echo "✓ prepareForCart succeeded!\n";
    echo "Cart data:\n";
    print_r($cartData);

} catch (\Exception $e) {
    echo "✗ prepareForCart FAILED!\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "\nStack trace:\n";
    echo $e->getTraceAsString() . "\n";
}

// Check cart_items table structure
echo "\n\nChecking cart_items table structure...\n";
$columns = DB::select("SHOW COLUMNS FROM cart_items");
foreach ($columns as $col) {
    $nullable = $col->Null == 'NO' ? 'REQUIRED' : 'nullable';
    $default = $col->Default ? " (default: {$col->Default})" : '';
    echo "  {$col->Field}: {$col->Type} - {$nullable}{$default}\n";
}

// Try creating cart item directly
echo "\n\nTrying to create cart item directly...\n";

use Webkul\Checkout\Repositories\CartRepository;
use Webkul\Checkout\Repositories\CartItemRepository;

$cartRepo = app(CartRepository::class);
$cartItemRepo = app(CartItemRepository::class);

// Get or create cart
$cart = DB::table('cart')
    ->where('customer_email', 'baniksuman918@gmail.com')
    ->where('is_active', 1)
    ->first();

if (!$cart) {
    echo "  ✗ No active cart found\n";
} else {
    echo "  Cart ID: {$cart->id}\n";

    // Try creating cart item
    try {
        $cartItemData = [
            'cart_id' => $cart->id,
            'product_id' => 15,
            'sku' => $product->sku,
            'quantity' => 1,
            'name' => $product->name,
            'price' => $product->price,
            'price_incl_tax' => $product->price,
            'base_price' => $product->price,
            'base_price_incl_tax' => $product->price,
            'total' => $product->price,
            'total_incl_tax' => $product->price,
            'base_total' => $product->price,
            'base_total_incl_tax' => $product->price,
            'weight' => $product->weight ?? 0,
            'total_weight' => $product->weight ?? 0,
            'base_total_weight' => $product->weight ?? 0,
            'type' => 'simple',
            'additional' => ['product_id' => 15, 'quantity' => 1],
        ];

        echo "\n  Attempting to create cart item with data:\n";
        print_r($cartItemData);

        $cartItem = $cartItemRepo->create($cartItemData);

        echo "\n  ✓ Cart item created! ID: {$cartItem->id}\n";

        // Verify in database
        $dbItem = DB::table('cart_items')->where('id', $cartItem->id)->first();
        if ($dbItem) {
            echo "  ✓ Verified in database\n";
        } else {
            echo "  ✗ NOT found in database!\n";
        }

    } catch (\Exception $e) {
        echo "  ✗ Failed to create cart item!\n";
        echo "  Error: " . $e->getMessage() . "\n";
        echo "\n  Stack trace:\n";
        echo $e->getTraceAsString() . "\n";
    }
}
