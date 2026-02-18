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
        'content'           => 'Full content here...',
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
        'content'           => 'Full content here...',
        'author'            => 'THF Concierge',
        'reading_time'      => 5,
        'status'            => 1,
    ],
    [
        'title'             => 'Diwali Delights: Sweet Traditions',
        'slug'              => 'diwali-delights',
        'category'          => 'Seasonal',
        'image'             => 'https://images.unsplash.com/photo-1604861979844-fe5f17c52ef6?w=800',
        'short_description' => 'A journey through regional Diwali sweet traditions.',
        'content'           => 'Full content here...',
        'author'            => 'Cultural Desk',
        'reading_time'      => 6,
        'status'            => 1,
    ],
    [
        'title'             => 'The Sweet Balance: Natural Sweeteners',
        'slug'              => 'sweet-balance',
        'category'          => 'Health',
        'image'             => 'https://images.unsplash.com/photo-1587049352846-4a222e784098?w=800',
        'short_description' => 'How we\'re incorporating dates, jaggery, and honey into our sweets.',
        'content'           => 'Full content here...',
        'author'            => 'Health Expert',
        'reading_time'      => 7,
        'status'            => 1,
    ],
    [
        'title'             => 'A Day in Our Kitchen',
        'slug'              => 'day-in-our-kitchen',
        'category'          => 'Behind Scenes',
        'image'             => 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800',
        'short_description' => 'Step inside our state-of-the-art kitchen.',
        'content'           => 'Full content here...',
        'author'            => 'Chef THF',
        'reading_time'      => 4,
        'status'            => 1,
    ]
];

foreach ($blogs as $blogData) {
    Blog::updateOrCreate(['slug' => $blogData['slug']], $blogData);
}

// --- SEED RECIPES ---
$recipes = [
    ['title' => 'THF Signature Baklava', 'slug' => 'baklava', 'category' => 'Traditional', 'image' => 'https://images.unsplash.com/photo-1519676867240-f03562e64548?w=800', 'description' => 'Signature baklava recipe.', 'prep_time' => '45 mins', 'difficulty' => 'Advanced', 'status' => 1],
    ['title' => 'Date & Nut Truffles', 'slug' => 'date-truffles', 'category' => 'Modern', 'image' => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=800', 'description' => 'Energy truffles.', 'prep_time' => '20 mins', 'difficulty' => 'Easy', 'status' => 1],
    ['title' => 'Diwali Dry Fruit Ladoo', 'slug' => 'diwali-ladoo', 'category' => 'Festive', 'image' => 'https://images.unsplash.com/photo-1605105526819-bf0d67b86a20?w=800', 'description' => 'Festive ladoo.', 'prep_time' => '30 mins', 'difficulty' => 'Medium', 'status' => 1],
    ['title' => 'Rose & Pistachio Shrikhand', 'slug' => 'rose-shrikhand', 'category' => 'Quick', 'image' => 'https://images.unsplash.com/photo-1495147466023-ac5c588e2e94?w=800', 'description' => 'Quick shrikhand.', 'prep_time' => '15 mins', 'difficulty' => 'Easy', 'status' => 1],
];

foreach ($recipes as $recipeData) {
    Recipe::updateOrCreate(['slug' => $recipeData['slug']], $recipeData);
}

echo "Seeding completed successfully!\n";
