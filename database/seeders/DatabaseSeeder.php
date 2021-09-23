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
        // \App\Models\User::factory(10)->create();
        $this->call([
           AdminSeeder::class,
	 OwnerSeeder::class,
	 //実行したいシーダーファイルを指定する。
	 //php artisan migrate:refresh --seed  で実行する
        ]);




    }
}
