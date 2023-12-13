<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreateBlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('main_page_blocks', function(Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('address');
            $table->dropColumn('price');
            $table->dropColumn('background');
            $table->dropColumn('button_title');
            $table->dropColumn('button_url');
            $table->dropColumn('image');
        });
        Schema::table('main_page_blocks', function(Blueprint $table) {
            $table->string('title', 250)->nullabe()->after('content')->default('');
            $table->string('address', 250)->nullabe()->after('title')->default('');
            $table->float('price', 10, 2)->nullabe()->after('address')->default(0);
            $table->string('background', 12)->nullabe()->after('price')->default('');
            $table->string('button_title', 250)->nullabe()->after('background')->default('');
            $table->string('button_url', 250)->nullabe()->after('button_title')->default('');
            $table->string('image', 300)->nullabe()->after('button_url')->default('');
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
            $table->dropColumn('title');
            $table->dropColumn('address');
            $table->dropColumn('price');
            $table->dropColumn('background');
            $table->dropColumn('button_title');
            $table->dropColumn('button_url');
            $table->dropColumn('image');
        });
        Schema::table('main_page_blocks', function(Blueprint $table) {
            $table->string('title', 250)->nullabe()->after('content')->default(null);
            $table->string('address', 250)->nullabe()->after('title')->default(null);
            $table->float('price', 10, 2)->nullabe()->after('address')->default(null);
            $table->string('background', 12)->nullabe()->after('price')->default(null);
            $table->string('button_title', 250)->nullabe()->after('background')->default(null);
            $table->string('button_url', 250)->nullabe()->after('button_title')->default(null);
            $table->string('image', 300)->nullabe()->after('button_url')->default(null);
        });
    }
}
