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
        Schema::create('maintenaces', function (Blueprint $table) {
            $table->id();
            $table->integer('atm_id');
            $table->string('maintenace_name');
            $table->date('maintenace_date');
            $table->timestamps();
            $table->foreign('atm_id')
                    ->references('id')
                    ->on('usings')
                    ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenaces');
    }
};
