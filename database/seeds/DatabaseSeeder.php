<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call(LaratrustSeeder::class);

        DB::table('posts')->insert([
        'title_sq' => 'Titulli ne shqip',
        'title_de' => 'Das ist title de',
        'desc_sq' => 'pershkrim ne shqip',
        'desc_de' => 'desc in de',
        'slug_sq' => 'slug title',
        'slug_de' => 'slug title de',
        'category_id' => '1',
    ]);


        DB::table('post_categories')->insert([
            'name_sq' => 'Hadithe',
            'name_de' => 'Hadithe De',

        ]);
    }
}
