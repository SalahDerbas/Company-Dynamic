<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('faq_heading')->nullable();
            $table->string('mt_faq')->nullable();
            $table->text('md_faq')->nullable();
            $table->foreignId('lang_id')->constrained('languages')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('page_faqs');
    }
}
