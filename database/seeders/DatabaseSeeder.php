<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create([
            'name' => 'Mustafa kamel',
            'email' => 'mostafak252@gmail.com',
        ]);
        \App\Models\Courier::factory(5)->has(
            \App\Models\Shipping::factory()->hasAttached(
                \App\Models\Product::factory(5),
                ['count' => 3]
            )
        )->create();
    }
}
