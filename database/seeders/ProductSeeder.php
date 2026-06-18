<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 15 Pro Max 256GB',
                'description' => 'Smartphone flagship Apple dengan chip A17 Pro, kamera 48MP, dan material titanium alami.',
                'price' => 22499000,
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'description' => 'Android premium dengan Galaxy AI, Snapdragon 8 Gen 3, S-Pen terintegrasi, dan kamera 200MP.',
                'price' => 20999000,
            ],
            [
                'name' => 'Sony WH-1000XM5 Wireless Headphones',
                'description' => 'Headphone wireless premium dengan Noise Canceling (ANC) industri terbaik dan daya tahan baterai hingga 30 jam.',
                'price' => 4499000,
            ],
            [
                'name' => 'MacBook Air M3 13-inch',
                'description' => 'Laptop ultra-thin Apple dengan chip M3 terbaru, RAM 8GB, SSD 256GB, desain tanpa kipas (silent).',
                'price' => 16499000,
            ],
            [
                'name' => 'Asus ROG Zephyrus G14',
                'description' => 'Laptop gaming tipis berperforma tinggi dengan AMD Ryzen 9, RTX 4060, dan layar Nebula OLED 120Hz.',
                'price' => 28999000,
            ],
            [
                'name' => 'Logitech MX Master 3S Wireless Mouse',
                'description' => 'Mouse ergonomis untuk produktivitas tingkat tinggi dengan sensor 8K DPI dan scroll elektromagnetik MagSpeed.',
                'price' => 1689000,
            ],
            [
                'name' => 'Keychron K2 V2 Mechanical Keyboard',
                'description' => 'Keyboard mekanikal wireless 75% layout dengan Gateron Switch, RGB Backlight, mendukung Mac dan Windows.',
                'price' => 1250000,
            ],
            [
                'name' => 'Anker PowerCore 24K Power Bank',
                'description' => 'Powerbank berkapasitas besar 24.000mAh dengan output daya cepat Smart Digital Display 140W GaN Prime.',
                'price' => 1999000,
            ],
            [
                'name' => 'Xiaomi Monitor Gaming 27-inch',
                'description' => 'Monitor gaming resolusi 2K (WQHD) dengan refresh rate 165Hz, IPS panel, dan 95% DCI-P3 color gamut.',
                'price' => 3599000,
            ],
            [
                'name' => 'PlayStation 5 Slim Digital Edition',
                'description' => 'Konsol game generasi terbaru dari Sony versi Slim dengan SSD 1TB berkecepatan tinggi tanpa slot disc.',
                'price' => 7499000,
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}