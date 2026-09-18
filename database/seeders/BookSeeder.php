<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['title' => 'Mari Bahasa Inggris', 'author' => 'Prof. Yoresky Bilma Bunga', 'category' => 'sains', 'status' => 'available', 'spine_color' => '#A63D2F'],
            ['title' => 'Sang Dao Abadi', 'author' => 'Prof. Immanuel Matasak', 'category' => 'fiksi', 'status' => 'available', 'spine_color' => '#A63D2F'],
            ['title' => 'Legenda Pendekar Suci', 'author' => 'Prof. Herdianto Bilma Bunga', 'category' => 'fiksi', 'status' => 'available', 'spine_color' => '#A63D2F'],
            ['title' => 'Jejak di Tanah Basah', 'author' => 'Rani Kusuma', 'category' => 'fiksi', 'status' => 'available', 'spine_color' => '#A63D2F'],
            ['title' => 'Bintang yang Tak Padam', 'author' => 'Aditya Prasetyo', 'category' => 'fiksi', 'status' => 'borrowed', 'spine_color' => '#35586B'],
            ['title' => 'Menghitung Ombak', 'author' => 'Sarah Wijaya', 'category' => 'non-fiksi', 'status' => 'available', 'spine_color' => '#C08A3E'],
            ['title' => 'Semesta dalam Genggaman', 'author' => 'Dr. Budi Santoso', 'category' => 'sains', 'status' => 'available', 'spine_color' => '#6B7A3A'],
            ['title' => 'Kisah dari Rak Belakang', 'author' => 'Nadia Permata', 'category' => 'fiksi', 'status' => 'available', 'spine_color' => '#A63D2F'],
            ['title' => 'Ekonomi untuk Semua', 'author' => 'Hendra Wibowo', 'category' => 'non-fiksi', 'status' => 'borrowed', 'spine_color' => '#C08A3E'],
            ['title' => 'Petualangan Kancil dan Kawan', 'author' => 'Tim Cendekia', 'category' => 'anak', 'status' => 'available', 'spine_color' => '#35586B'],
            ['title' => 'Jejak Nusantara', 'author' => 'Prof. Siti Amalia', 'category' => 'sejarah', 'status' => 'available', 'spine_color' => '#6B7A3A'],
            ['title' => 'Rahasia di Balik Bintang', 'author' => 'Dewi Anggraini', 'category' => 'sains', 'status' => 'available', 'spine_color' => '#C08A3E'],
        ];

        Book::query()->upsert($books, ['title'], ['author', 'category', 'status', 'spine_color']);
    }
}