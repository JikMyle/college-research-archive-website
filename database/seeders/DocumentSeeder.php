<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Document;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Document::factory()
            ->has(Author::factory()->count(2))
            ->count(100)
            ->create()
        ;
    }
}
