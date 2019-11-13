<?php

use Illuminate\Database\Seeder;
use App\Achievement_time;

class AchievementTimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Achievement_time::create([
        'time' => '3時間未満',
      ]);

      Achievement_time::create([
        'time' => '5時間',
      ]);

      Achievement_time::create([
        'time' => '10時間',
      ]);

      Achievement_time::create([
        'time' => '15時間',
      ]);

      Achievement_time::create([
        'time' => '20時間',
      ]);

      Achievement_time::create([
        'time' => '25時間',
      ]);

      Achievement_time::create([
        'time' => '30時間',
      ]);

      Achievement_time::create([
        'time' => '50時間',
      ]);

      Achievement_time::create([
        'time' => '70時間',
      ]);

      Achievement_time::create([
        'time' => '100時間',
      ]);

      Achievement_time::create([
        'time' => '150時間',
      ]);

      Achievement_time::create([
        'time' => '200時間',
      ]);

      Achievement_time::create([
        'time' => '250時間',
      ]);

      Achievement_time::create([
        'time' => '300時間以上',
      ]);
    }
}
