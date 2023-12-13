<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->enum('size', ['small','medium','large']);
            $table->text('content');
            $table->enum('background', ['y','n']);
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
        Schema::dropIfExists('loan_programs');
    }
}
