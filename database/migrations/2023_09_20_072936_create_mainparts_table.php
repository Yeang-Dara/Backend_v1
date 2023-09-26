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
        Schema::create('mainparts', function (Blueprint $table) {
            $table->id();
            $table->integer('machine_id');
            $table->string('mainpart_name');
            $table->string('part_number');
            $table->string('replacer_name');
            $table->string('remarks');
            $table->date('replace_date');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('machine_id')
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
        Schema::dropIfExists('mainparts');
    }
};
