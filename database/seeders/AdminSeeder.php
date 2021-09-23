<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// DBクラスでもクエリビルダでもDBファサードによる記述のため
// Illuminate\Support\Facades\DBをuseします。
use Illuminate\Support\Facades\Hash;
//パスワードのハッシュ化のため

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
             'name' => 'test',
	   'email' => 'test@test.com',
	   'password' => Hash::make('password123'),
	   'created_at' => '2021/01/01 11:11:11'
        ]);
    }
}
