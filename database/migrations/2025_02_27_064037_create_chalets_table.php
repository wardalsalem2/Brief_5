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
        Schema::create('chalets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->decimal('price_per_day', 10, 2);
            $table->string('address');
            $table->text('description');
            $table->decimal('discount', 5, 2)->nullable();
            $table->enum('status', ['available', 'not available']);
            $table->date('available_start')->nullable();
            $table->date('available_end')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chalets');
    }
};
