<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('top_bar_email')->nullable();
            $table->string('top_bar_phone')->nullable();
            $table->string('mail_mailer')->nullable();
            $table->string('mail_host')->nullable();
            $table->integer('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->string('mail_from_address')->nullable();
            $table->string('mail_from_name')->nullable();
            $table->string('banner_about')->nullable();
            $table->string('banner_faq')->nullable();
            $table->string('banner_service')->nullable();
            $table->string('banner_testimonial')->nullable();
            $table->string('banner_news')->nullable();
            $table->string('banner_event')->nullable();
            $table->string('banner_contact')->nullable();
            $table->string('banner_search')->nullable();
            $table->string('banner_terms')->nullable();
            $table->string('banner_privacy')->nullable();
            $table->string('banner_team')->nullable();
            $table->string('banner_portfolio')->nullable();
            $table->string('banner_verify_subscriber')->nullable();
            $table->string('banner_pricing')->nullable();
            $table->string('banner_photo_gallery')->nullable();
            $table->string('front_end_color')->nullable();
            $table->string('sidebar_total_recent_post')->nullable();
            $table->string('sidebar_total_upcoming_event')->nullable();
            $table->string('sidebar_total_past_event')->nullable();
            $table->string('website_name')->nullable();
            $table->string('google_recaptcha_key')->nullable();
            $table->string('google_recaptcha_secret')->nullable();
            $table->string('google_recaptcha_status')->nullable();
            $table->string('language_status')->nullable();
            $table->longText('tawk_live_chat_code')->nullable();
            $table->string('tawk_live_chat_status')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
