<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDataAchievementTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('achievement_time', function (Blueprint $table) {
          //
        });

        DB::table('achievement_time')->insert([
            ['time' => '3時間未満'],
            ['time' => '5時間'],
            ['time' => '10時間'],
            ['time' => '15時間'],
            ['time' => '20時間'],
            ['time' => '25時間'],
            ['time' => '30時間'],
            ['time' => '50時間'],
            ['time' => '70時間'],
            ['time' => '100時間'],
            ['time' => '150時間'],
            ['time' => '200時間'],
            ['time' => '250時間'],
            ['time' => '300時間以上'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('achievement_time', function (Blueprint $table) {
            //
        });
    }
}
