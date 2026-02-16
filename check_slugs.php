<?php
use Webkul\Category\Models\Category;
foreach(Category::all() as $cat) {
    echo "ID: " . $cat->id . " | Slug: " . $cat->slug . "
";
}
