<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

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
            $table->integer('sparepart_id');
            $table->string('part_number')->nullable();
            $table->string('replacer_name');
            $table->date('replace_date');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('sparepart_id')
                    ->references('id')
                    ->on('spareparts')
                    ->onDelete('CASCADE');
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
