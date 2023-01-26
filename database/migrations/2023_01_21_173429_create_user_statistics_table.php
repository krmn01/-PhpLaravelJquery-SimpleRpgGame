<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /*
     *
     * 'level',
        'currentExp',
        'intelligence',
        'strength',
        'vitality',
        'avatarPath',
        'user_id'
     */
    public function up()
    {
        Schema::create('user_statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('level',false,true);
            $table->integer('currentExp',false,true);
            $table->integer('intelligence',false,true);
            $table->integer('strength',false,true);
            $table->integer('vitality',false,true);
            $table->integer('gold',false,true);
            $table->string('avatarPath',255);
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_statistics');
    }
};
