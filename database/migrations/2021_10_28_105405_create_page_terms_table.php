<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_terms', function (Blueprint $table) {
            $table->id();
            $table->string('term_heading')->nullable();
            $table->longText('term_content')->nullable();
            $table->string('mt_term')->nullable();
            $table->text('md_term')->nullable();
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
        Schema::dropIfExists('page_terms');
    }
}
