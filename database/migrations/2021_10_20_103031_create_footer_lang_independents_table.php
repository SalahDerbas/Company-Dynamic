<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFooterLangIndependentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_lang_independents', function (Blueprint $table) {
            $table->id();
            $table->integer('footer_recent_news_item')->nullable();
            $table->integer('footer_recent_portfolio_item')->nullable();
            $table->string('cta_background')->nullable();
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
        Schema::dropIfExists('footer_lang_independents');
    }
}
