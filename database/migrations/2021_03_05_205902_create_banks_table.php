<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {

            $table->id();
            $table->timestamps();

            $table->string('bank_code');
            $table->string('bank_name');
            $table->string('agency');
            $table->string('account');
            $table->string('bank_cpf');

            $table->boolean('active_bank')->default(true);
            $table->foreignId('user_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
