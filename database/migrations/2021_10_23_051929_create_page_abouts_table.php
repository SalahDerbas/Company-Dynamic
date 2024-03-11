<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_abouts', function (Blueprint $table) {
            $table->id();
            $table->string('about_heading')->nullable();
            $table->longText('about_content')->nullable();
            $table->string('mt_about')->nullable();
            $table->text('md_about')->nullable();
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
        Schema::dropIfExists('page_abouts');
    }
}
