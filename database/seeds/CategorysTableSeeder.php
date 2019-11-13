<?php

use Illuminate\Database\Seeder;
use App\Category;


class CategorysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
          'name' => '生活',
        ]);

        Category::create([
          'name' => '仕事',
        ]);

        Category::create([
          'name' => '学習',
        ]);

        Category::create([
          'name' => '趣味',
        ]);

        Category::create([
          'name' => '副業',
        ]);

        Category::create([
          'name' => 'ダイエット',
        ]);

        Category::create([
          'name' => 'その他',
        ]);
    }
}
