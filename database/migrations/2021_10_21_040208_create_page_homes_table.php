<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_homes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('home_welcome_title')->nullable();
            $table->string('home_welcome_subtitle')->nullable();
            $table->longText('home_welcome_text')->nullable();
            $table->string('home_welcome_pbar1_text')->nullable();
            $table->string('home_welcome_pbar1_value')->nullable();
            $table->string('home_welcome_pbar2_text')->nullable();
            $table->string('home_welcome_pbar2_value')->nullable();
            $table->string('home_welcome_pbar3_text')->nullable();
            $table->string('home_welcome_pbar3_value')->nullable();
            $table->string('home_welcome_pbar4_text')->nullable();
            $table->string('home_welcome_pbar4_value')->nullable();
            $table->string('home_welcome_pbar5_text')->nullable();
            $table->string('home_welcome_pbar5_value')->nullable();
            $table->string('home_why_choose_title')->nullable();
            $table->string('home_why_choose_subtitle')->nullable();
            $table->string('home_feature_title')->nullable();
            $table->string('home_feature_subtitle')->nullable();
            $table->string('home_service_title')->nullable();
            $table->string('home_service_subtitle')->nullable();
            $table->string('counter_1_title')->nullable();
            $table->string('counter_1_value')->nullable();
            $table->string('counter_1_icon')->nullable();
            $table->string('counter_2_title')->nullable();
            $table->string('counter_2_value')->nullable();
            $table->string('counter_2_icon')->nullable();
            $table->string('counter_3_title')->nullable();
            $table->string('counter_3_value')->nullable();
            $table->string('counter_3_icon')->nullable();
            $table->string('counter_4_title')->nullable();
            $table->string('counter_4_value')->nullable();
            $table->string('counter_4_icon')->nullable();
            $table->string('home_portfolio_title')->nullable();
            $table->string('home_portfolio_subtitle')->nullable();
            $table->string('home_booking_form_title')->nullable();
            $table->string('home_booking_faq_title')->nullable();
            $table->string('home_team_title')->nullable();
            $table->string('home_team_subtitle')->nullable();
            $table->string('home_ptable_title')->nullable();
            $table->string('home_ptable_subtitle')->nullable();
            $table->string('home_testimonial_title')->nullable();
            $table->string('home_testimonial_subtitle')->nullable();
            $table->string('home_blog_title')->nullable();
            $table->string('home_blog_subtitle')->nullable();
            $table->string('home_cta_text')->nullable();
            $table->string('home_cta_button_text')->nullable();
            $table->string('home_cta_button_url')->nullable();
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
        Schema::dropIfExists('page_homes');
    }
}
