<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('web_name');
            $table->string('web_logo');
            $table->string('web_favicon');
            $table->text('web_description');
            $table->string('web_meta_title'); 
            $table->string('web_meta_keywords'); 
            $table->text('web_meta_description'); 
            $table->text('web_google_analytics')->nullable(); 
            $table->text('web_facebook_pixel')->nullable(); 
            $table->text('web_header_script')->nullable(); 
            $table->text('web_footer_script')->nullable(); 
            $table->string('web_og_image')->nullable();
            $table->tinyInteger('web_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
