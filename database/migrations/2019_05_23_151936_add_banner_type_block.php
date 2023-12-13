<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerTypeBlock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE main_page_blocks MODIFY `type` enum('top-left','top-right','center-left','center-right','bottom-left','bottom-right','banner', 'featured-transactions') DEFAULT 'top-right';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("ALTER TABLE main_page_blocks MODIFY `type` enum('top-left','top-right','center-left','center-right','bottom-left','bottom-right') DEFAULT 'top-right';");
    }
}
