<?php
use Webkul\Category\Models\Category;

$names = ['Labon', 'Baklava', 'Dates', 'Mewabite', 'Assorted'];

foreach ($names as $name) {
    $category = Category::whereHas('translations', function($q) use ($name) {
        $q->where('name', 'like', '%' . $name . '%');
    })->first();

    if ($category) {
        echo "CATEGORY: " . $name . " | ID: " . $category->id . "
";
        foreach ($category->products as $product) {
            echo "  - ID: " . $product->id . " | Name: " . $product->name . "
";
        }
    } else {
        echo "CATEGORY: " . $name . " | NOT FOUND
";
    }
}
