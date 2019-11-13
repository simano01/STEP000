<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDataCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categorys', function (Blueprint $table) {
          //
        });

        DB::table('categorys')->insert([
            ['name' => '仕事'],
            ['name' => '学習'],
            ['name' => '副業'],
            ['name' => '生活'],
            ['name' => '趣味'],
            ['name' => 'ダイエット'],
            ['name' => 'その他'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categorys', function (Blueprint $table) {
            //
        });
    }
}
