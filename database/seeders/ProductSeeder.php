<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Minimalist Desk Lamp',
                'description' => 'A sleek and modern LED desk lamp, perfect for focused work. Adjustable brightness.',
                'price' => 49.99,
                'image_url' => 'https://placehold.co/600x400/EFEFEF/AAAAAA?text=Desk+Lamp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ergonomic Office Chair',
                'description' => 'High-back ergonomic chair with lumbar support and breathable mesh. Improves posture and comfort.',
                'price' => 299.50,
                'image_url' => 'https://placehold.co/600x400/EFEFEF/AAAAAA?text=Office+Chair',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wireless Noise-Cancelling Headphones',
                'description' => 'Over-ear headphones with active noise-cancellation and long battery life. Immersive sound quality.',
                'price' => 149.00,
                'image_url' => 'https://placehold.co/600x400/EFEFEF/AAAAAA?text=Headphones',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Smart Water Bottle',
                'description' => 'Tracks your water intake and glows to remind you to hydrate. Stainless steel, 500ml.',
                'price' => 35.75,
                'image_url' => 'https://placehold.co/600x400/EFEFEF/AAAAAA?text=Water+Bottle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Portable SSD 1TB',
                'description' => 'Compact and durable 1TB portable solid-state drive. Fast data transfer speeds.',
                'price' => 99.99,
                'image_url' => 'https://placehold.co/600x400/EFEFEF/AAAAAA?text=Portable+SSD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'name' => 'Organic Cotton T-Shirt',
                'description' => 'Soft and comfortable t-shirt made from 100% organic cotton. Available in various colors.',
                'price' => 24.99,
                'image_url' => 'https://placehold.co/600x400/EFEFEF/AAAAAA?text=Cotton+T-Shirt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Reusable Shopping Bag Set',
                'description' => 'Set of 5 durable and eco-friendly shopping bags. Foldable and machine washable.',
                'price' => 15.50,
                'image_url' => 'https://placehold.co/600x400/EFEFEF/AAAAAA?text=Shopping+Bags',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yoga Mat Premium',
                'description' => 'Non-slip, eco-friendly yoga mat with extra cushioning for comfort and support.',
                'price' => 45.00,
                'image_url' => 'https://placehold.co/600x400/EFEFEF/AAAAAA?text=Yoga+Mat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Glass Meal Prep Containers',
                'description' => 'Set of 5 glass containers with airtight lids. Microwave, oven, and dishwasher safe.',
                'price' => 39.99,
                'image_url' => 'https://placehold.co/600x400/EFEFEF/AAAAAA?text=Meal+Containers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bluetooth Speaker Waterproof',
                'description' => 'Portable waterproof Bluetooth speaker with rich sound and 12-hour playtime.',
                'price' => 59.95,
                'image_url' => 'https://placehold.co/600x400/EFEFEF/AAAAAA?text=Bluetooth+Speaker',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
