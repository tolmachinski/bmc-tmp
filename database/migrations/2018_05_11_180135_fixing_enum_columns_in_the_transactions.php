<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixingEnumColumnsInTheTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('show_in_background');
            $table->dropColumn('home_page');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('show_in_background', [0, 1])->default(0);
            $table->enum('home_page', [0, 1])->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('show_in_background');
            $table->dropColumn('home_page');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('show_in_background', [0, 1]);
            $table->enum('home_page', [0, 1]);
        });
    }
}
