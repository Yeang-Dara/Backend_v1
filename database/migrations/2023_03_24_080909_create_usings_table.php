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
        Schema::create('usings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('atm_id')->unique();
            $table->string('alias_id')->nullable();
            $table->date('install_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('take_over_date');
            $table->string('category_name');
            $table->string('serial_number')->unique();
            $table->string('apk_version')->nullable();
            $table->string('image_version')->nullable();
            $table->string('mainboard_version')->nullable();
            $table->string('android_version')->nullable();
            $table->string('model_name');
            $table->integer('warranty_days')->nullable();
            $table->string('comment')->nullable();
            $table->string('type_name');
            $table->string('status');
            $table->string('bank_name');
            $table->string('site_id');
            $table->string('region_name');
            $table->string('site_name');
            $table->string('location');
            $table->string('city');
            $table->string('state_name');
            $table->string('accessibility')->nullable();
            $table->string('address');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usings');
    }
};
