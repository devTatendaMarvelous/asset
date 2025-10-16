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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('type_id')->references('id')->on('asset_types'); // e.g. laptop, tablet
            $table->string('brand');
            $table->string('serial_number')->unique();
            $table->string('description')->nullable();
            $table->enum('status', [
                'ASSIGNED',
                'STOLEN',
                'LOST',
                'DEREGISTERED'
            ])->default('ASSIGNED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
