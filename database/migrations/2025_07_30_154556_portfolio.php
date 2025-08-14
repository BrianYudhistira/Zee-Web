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
        // Add projects table in same migration for related data
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "Zee Scraper APP", "Arnet Dashboard Web"
            $table->text('image')->nullable(); // Path to project image
            $table->text('description'); // Long description paragraph
            $table->text('link')->nullable(); // Link to project
            $table->json('tech_stack')->nullable(); // Array of technology stack ["devicon-vuejs-plain", "devicon-tailwindcss-plain"]
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Skill name
            $table->text('icon')->nullable(); // Path to skill icon
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('portfolios');
    }
};
