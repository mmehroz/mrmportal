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
            $table->bigIncrements('id');
            $table->string('client_name');
            $table->string('logo_header')->nullable();
            $table->string('logo_footer')->nullable();
            $table->string('fav_icon')->nullable();
            $table->longText('header_content')->nullable();
            $table->longText('footer_content')->nullable();
            $table->string('contact_number')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('terms_condition')->nullable();
            $table->longText('address')->nullable();
            $table->integer('display_product_images')->default(1);
            $table->string('website_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('google_plus_link')->nullable();
            $table->tinyInteger('mode_dark')->default(0);
            $table->string('header_color')->default('#ff0000');
            $table->string('footer_color')->default('#ff0000');
            $table->string('theme_primary_color')->default('#ff0000');
            $table->string('theme_variant_color')->default('#ff0000');
            $table->string('currency')->default('Rs. ');
            $table->string('is_delivery')->nullable();
            $table->string('delivery_flat_charges')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
