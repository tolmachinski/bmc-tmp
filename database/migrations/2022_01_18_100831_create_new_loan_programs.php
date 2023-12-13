<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewLoanPrograms extends Migration
{

    public function __construct()
{
    
}
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `loan_programs` CHANGE `size` `size` ENUM('small','medium','large') NULL DEFAULT NULL;");
        DB::statement("ALTER TABLE loan_programs CHANGE background background enum('y', 'n') NULL DEFAULT NULL");
        Schema::table('loan_programs', function (Blueprint $table) {
            
            //$table->enum('size', ['small','medium','large'])->default('small')->change();
            //$table->text('content')->default(NULL)->nullable()->change();
            //$table->enum('background', ['y','n'])->default('y')->change();
            $table->string('img', 100);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_programs', function (Blueprint $table) {
            $table->dropColumn('img');
        });
    }
}
