<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->string('short', 50);
            $table->text('content')->nullable();
            $table->float('price');
            $table->date('date');
            $table->enum('size', ['small','medium','large']);
            $table->string('img', 250);

            $table->enum('show_in_background', [0, 1]);
            $table->enum('home_page', [0, 1]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
