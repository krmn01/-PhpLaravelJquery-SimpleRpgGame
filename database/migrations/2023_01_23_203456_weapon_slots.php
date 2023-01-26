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
    public function up()
    {
        Schema::create('weapon_slots', function (Blueprint $table) {
            $table->id();
            $table->string('Name',255);
            $table->integer('dmg',false,true);
            $table->string('imgPath',255);
            $table->integer('value',false,true);
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
        Schema::dropIfExists('weapon_slots');
    }
};
