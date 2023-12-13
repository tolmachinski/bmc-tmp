<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeUrlFieldInPressNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        Schema::table('presses', function (Blueprint $table) {
            $table->string('url', 2000)->nullable()->default(null)->change();
            $table->string('pdf', 300)->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        Schema::table('presses', function (Blueprint $table) {
            $table->string('url', 2000)->nullable(false)->change();
            $table->string('pdf', 300)->nullable(false)->change();
        });
    }
}
