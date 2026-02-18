<?php

use Webkul\CMS\Models\Blog;
use Webkul\CMS\Models\Recipe;

// --- SEED BLOGS ---
$blogs = [
    [
        'title'             => 'The Art of Baklava: A Centuries-Old Tradition',
        'slug'              => 'art-of-baklava',
        'category'          => 'Sweet Making',
        'image'             => 'https://images.unsplash.com/photo-1519676867240-f03562e64548?w=800',
        'short_description' => 'Discover the intricate craftsmanship behind our premium baklava, from selecting the finest pistachios to perfecting the delicate layering technique.',
        'content'           => 'Discover the intricate craftsmanship behind our premium baklava, from selecting the finest pistachios to perfecting the delicate layering technique passed down through generations of master confectioners.',
        'author'            => 'THF Master',
        'reading_time'      => 8,
        'status'            => 1,
    ],
    [
        'title'             => 'Corporate Gifting Trends 2025: Making Lasting Impressions',
        'slug'              => 'corporate-gifting-trends-2025',
        'category'          => 'Gifting',
        'image'             => 'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=800',
        'short_description' => 'Explore how premium sweets are becoming the preferred choice for corporate gifting, combining tradition with personal touch.',
        'content'           => 'Explore how premium sweets are becoming the preferred choice for corporate gifting, combining tradition with personal touch.',
        'author'            => 'THF Concierge',
        'reading_time'      => 5,
        'status'            => 1,
    ],
    [
        'title'             => 'Diwali Delights: Sweet Traditions Across India',
        'slug'              => 'diwali-delights',
        'category'          => 'Seasonal',
        'image'             => 'https://images.unsplash.com/photo-1604861979844-fe5f17c52ef6?w=800',
        'short_description' => 'A journey through regional Diwali sweet traditions and how we reimagining them for modern celebrations.',
        'content'           => 'A journey through regional Diwali sweet traditions and how we reimagining them for modern celebrations.',
        'author'            => 'Cultural Desk',
        'reading_time'      => 6,
        'status'            => 1,
    ]
];

foreach ($blogs as $blogData) {
    Blog::updateOrCreate(['slug' => $blogData['slug']], $blogData);
}

// --- SEED RECIPES ---
$recipes = [
    [
        'title'       => 'THF Signature Baklava',
        'slug'        => 'thf-signature-baklava',
        'category'    => 'Traditional',
        'image'       => 'https://images.unsplash.com/photo-1519676867240-f03562e64548?w=800',
        'description' => 'Our master confectioner reveals the secrets to making restaurant-quality baklava at home.',
        'prep_time'   => '45 mins',
        'cook_time'   => '35 mins',
        'servings'    => '8-10',
        'difficulty'  => 'Advanced',
        'ingredients' => ["500g premium phyllo dough","300g Iranian pistachios","250g clarified butter"],
        'instructions'=> ["Preheat oven to 180°C","Layer phyllo with butter","Bake until golden"],
        'status'      => 1,
    ],
    [
        'title'       => 'Date & Nut Energy Truffles',
        'slug'        => 'date-nut-truffles',
        'category'    => 'Modern',
        'image'       => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=800',
        'description' => 'Healthy, no-bake energy balls perfect for quick snacks or dessert.',
        'prep_time'   => '20 mins',
        'cook_time'   => '0 mins',
        'servings'    => '12 pieces',
        'difficulty'  => 'Easy',
        'ingredients' => ["2 cups pitted dates","1 cup mixed nuts","1/2 cup coconut"],
        'instructions'=> ["Pulse nuts in processor","Add dates and blend","Roll into balls"],
        'status'      => 1,
    ]
];

foreach ($recipes as $recipeData) {
    Recipe::updateOrCreate(['slug' => $recipeData['slug']], $recipeData);
}

echo "Seeding completed successfully!\n";
