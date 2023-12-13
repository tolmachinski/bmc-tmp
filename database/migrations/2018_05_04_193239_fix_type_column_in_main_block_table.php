<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixTypeColumnInMainBlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('main_page_blocks', function(Blueprint $table) {
            $table->dropColumn('type');
        });
        Schema::table('main_page_blocks', function(Blueprint $table) {
            $table->enum('type', ['top-left','top-right','center-left','center-right','bottom-left','bottom-right'])->default('top-right')->after('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('main_page_blocks', function(Blueprint $table) {
            $table->dropColumn('type');
        });
        Schema::table('main_page_blocks', function(Blueprint $table) {
            $table->enum('type', ['plain', 'plain-title', 'plain-image', 'plain-event', 'plain-carousel'])->default('plain')->after('content');
        });
    }
}
