<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageHomeLangIndependentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_home_lang_independents', function (Blueprint $table) {
            $table->id();
            $table->text('home_welcome_video')->nullable();
            $table->string('home_welcome_status')->nullable();
            $table->string('home_welcome_video_bg')->nullable();
            $table->string('home_why_choose_status')->nullable();
            $table->string('home_feature_status')->nullable();
            $table->string('home_service_status')->nullable();
            $table->string('counter_photo')->nullable();
            $table->string('counter_status')->nullable();
            $table->string('home_portfolio_status')->nullable();
            $table->string('home_booking_status')->nullable();
            $table->string('home_booking_photo')->nullable();
            $table->string('home_team_status')->nullable();
            $table->string('home_ptable_status')->nullable();
            $table->string('home_testimonial_photo')->nullable();
            $table->string('home_testimonial_status')->nullable();
            $table->string('home_blog_item')->nullable();
            $table->string('home_blog_status')->nullable();
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
        Schema::dropIfExists('page_home_lang_independents');
    }
}
