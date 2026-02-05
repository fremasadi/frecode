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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('position'); // Senior Fullstack Developer
            $table->string('company');
            $table->text('description')->nullable();
            $table->json('technologies')->nullable(); // ["React", "Node.js", "AWS"]
            $table->date('start_date');
            $table->date('end_date')->nullable(); // null = present
            $table->boolean('is_current')->default(false);
            $table->string('color')->default('cyan'); // cyan, purple, green, orange
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
