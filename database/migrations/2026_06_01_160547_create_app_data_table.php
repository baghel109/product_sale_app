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
        Schema::create('app_data', function (Blueprint $table) {
            $table->id();
            $table->string('logo_first_name');
            $table->string('logo_last_name');
            $table->string('heading');
            $table->text('location');
            $table->string('email');
            $table->string('mobile');
            $table->string('site_name');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->text('contact_touch')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_data');
    }
};
