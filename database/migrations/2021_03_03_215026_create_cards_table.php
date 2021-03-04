<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->double('value');
            $table->string('imageLink');
            $table->string('name');
            $table->string('english_name')->nullable();
            $table->integer('quantity');
            $table->boolean('isActive')->default(true);

            $table->foreignId('card_states_id');
            $table->foreignId('version_id');
            $table->foreignId('language_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
