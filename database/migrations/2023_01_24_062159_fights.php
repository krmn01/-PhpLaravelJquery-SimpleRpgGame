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
    'player1Hp',
        'player2Hp',
        'player1MaxHp',
        'player2MaxHp',
        'player1DmgMin',
        'player2DmgMin',
        'player1DmgMax',
        'player2DmgMax',
        'player2lvl',  /// do wyliczania ew. nagrody
        'user_id'
    */
    public function up()
    {
        Schema::create('fights', function (Blueprint $table) {
            $table->id();
            $table->integer('player1Hp',false,true);
            $table->integer('player2Hp',false,true);
            $table->integer('player1MaxHp',false,true);
            $table->integer('player2MaxHp',false,true);
            $table->integer('player1DmgMin',false,true);
            $table->integer('player2DmgMin',false,true);
            $table->integer('player1DmgMax',false,true);
            $table->integer('player2DmgMax',false,true);
            $table->integer('player2lvl',false,true);
            $table->boolean('playerAttacks'); // true - po wznowieniu walki atakuje gracz1, false przeciwnie.
            $table->timestamps();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fights');
    }
};
