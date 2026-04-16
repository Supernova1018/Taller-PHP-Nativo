<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use Database\Seeders\CategoriaSeeder;
use App\Models\Phone;
use Database\Seeders\PhoneSeeder;
use App\Models\User;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::factory()->count(10)->create();
    }
}
