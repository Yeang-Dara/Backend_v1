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
        Schema::create('spareparts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('spareparts_name');
            $table->integer('quantity');
            $table->integer('quantity_used');
            $table->integer('quantity_remain');
            $table->string('for_machine_model');
            $table->string('part_number');
            $table->integer('q_bti');
            $table->integer('q_deam');
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
        Schema::dropIfExists('spareparts');
    }
};