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
        'content'           => 'Discover the intricate craftsmanship behind our premium baklava...',
        'author'            => 'THF Master',
        'reading_time'      => 8,
        'status'            => 1,
    ],
    [
        'title'             => 'Corporate Gifting Trends 2025',
        'slug'              => 'corporate-gifting-trends-2025',
        'category'          => 'Gifting',
        'image'             => 'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=800',
        'short_description' => 'Explore how premium sweets are becoming the preferred choice for corporate gifting.',
        'content'           => 'Explore how premium sweets are becoming the preferred choice...',
        'author'            => 'THF Concierge',
        'reading_time'      => 5,
        'status'            => 1,
    ]
];

foreach ($blogs as $blogData) {
    Blog::updateOrCreate(['slug' => $blogData['slug']], $blogData);
}

// --- SEED ALL 9 RECIPES ---
$recipes = [
    [
        'title'       => 'THF Signature Baklava',
        'slug'        => 'baklava',
        'category'    => 'Traditional',
        'image'       => 'https://images.unsplash.com/photo-1519676867240-f03562e64548?w=800',
        'description' => 'Our master confectioner reveals the secrets to making restaurant-quality baklava at home.',
        'prep_time'   => '45 mins',
        'cook_time'   => '35 mins',
        'servings'    => '8-10',
        'difficulty'  => 'Advanced',
        'ingredients' => ['500g premium phyllo dough', '300g Iranian pistachios', '250g clarified butter', '1 cup sugar', '1 cup water'],
        'instructions'=> ['Preheat oven to 180°C', 'Butter the pan and layer 10 sheets', 'Sprinkle nuts and repeat', 'Bake until golden'],
        'status'      => 1,
    ],
    [
        'title'       => 'Date & Nut Energy Truffles',
        'slug'        => 'date-truffles',
        'category'    => 'Modern',
        'image'       => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=800',
        'description' => 'Healthy, no-bake energy balls perfect for quick snacks or dessert.',
        'prep_time'   => '20 mins',
        'cook_time'   => '0 mins',
        'servings'    => '12 pieces',
        'difficulty'  => 'Easy',
        'ingredients' => ['2 cups pitted dates', '1 cup mixed nuts', '1/2 cup coconut'],
        'instructions'=> ['Soak dates if dry', 'Pulse nuts in processor', 'Blend all and roll into balls'],
        'status'      => 1,
    ],
    [
        'title'       => 'Diwali Dry Fruit Ladoo',
        'slug'        => 'diwali-ladoo',
        'category'    => 'Festive',
        'image'       => 'https://images.unsplash.com/photo-1605105526819-bf0d67b86a20?w=800',
        'description' => 'Celebrate Diwali with these rich, nutritious ladoos made with 7 types of nuts.',
        'prep_time'   => '30 mins',
        'cook_time'   => '15 mins',
        'servings'    => '15 pieces',
        'difficulty'  => 'Medium',
        'ingredients' => ['1 cup almonds', '1 cup cashews', '2 tbsp ghee', 'Cardamom powder'],
        'instructions'=> ['Roast nuts until fragrant', 'Grind to coarse powder', 'Mix with ghee and roll'],
        'status'      => 1,
    ],
    [
        'title'       => 'Jaggery & Mixed Nut Barfi',
        'slug'        => 'jaggery-barfi',
        'category'    => 'Healthy',
        'image'       => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800',
        'description' => 'A healthier version using organic jaggery instead of sugar.',
        'prep_time'   => '25 mins',
        'cook_time'   => '20 mins',
        'servings'    => '16 pieces',
        'difficulty'  => 'Medium',
        'ingredients' => ['2 cups nuts', '1 cup jaggery', '1/2 tsp ginger powder'],
        'status'      => 1,
    ],
    [
        'title'       => 'Rose & Pistachio Shrikhand',
        'slug'        => 'rose-shrikhand',
        'category'    => 'Quick',
        'image'       => 'https://images.unsplash.com/photo-1495147466023-ac5c588e2e94?w=800',
        'description' => 'Elegant dessert ready in 15 minutes. Greek yogurt infused with rose water.',
        'prep_time'   => '15 mins',
        'difficulty'  => 'Easy',
        'status'      => 1,
    ],
    [
        'title'       => 'Premium Besan Ladoo',
        'slug'        => 'besan-ladoo',
        'category'    => 'Traditional',
        'image'       => 'https://images.unsplash.com/photo-1626132647523-66f5bf380027?w=800',
        'description' => 'Elevate the traditional besan ladoo with aged gram flour and Kashmiri saffron.',
        'prep_time'   => '40 mins',
        'difficulty'  => 'Advanced',
        'status'      => 1,
    ],
    [
        'title'       => 'Flourless Chocolate Date Cake',
        'slug'        => 'chocolate-cake',
        'category'    => 'Modern',
        'image'       => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=800',
        'description' => 'Rich, moist chocolate cake sweetened naturally with dates.',
        'prep_time'   => '30 mins',
        'difficulty'  => 'Medium',
        'status'      => 1,
    ],
    [
        'title'       => 'Red Carrot Halwa',
        'slug'        => 'gajar-halwa',
        'category'    => 'Seasonal',
        'image'       => 'https://images.unsplash.com/photo-1607532941433-304659e8198a?w=800',
        'description' => 'Winters favorite dessert made with red carrots and reduced milk.',
        'prep_time'   => '1 hour',
        'difficulty'  => 'Medium',
        'status'      => 1,
    ],
    [
        'title'       => 'Saffron Almond Milk',
        'slug'        => 'badam-milk',
        'category'    => 'Seasonal',
        'image'       => 'https://images.unsplash.com/photo-1603569283847-aa295f0d016a?w=800',
        'description' => 'Warm, comforting drink perfect for winter evenings.',
        'prep_time'   => '20 mins',
        'difficulty'  => 'Easy',
        'status'      => 1,
    ]
];

foreach ($recipes as $recipeData) {
    Recipe::updateOrCreate(['slug' => $recipeData['slug']], $recipeData);
}

echo "Seeding completed successfully!\n";
