<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rate_id');
            $table->date('date');
            $table->decimal('last', 10, 2);
            $table->decimal('change', 10, 4);
            $table->timestamps();
            $table->unique(['rate_id', 'date'], 'rateDateUniques');
            $table->index('rate_id', 'rateIndex');
            $table->index('date', 'dateIndex');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_rates');
    }
}
