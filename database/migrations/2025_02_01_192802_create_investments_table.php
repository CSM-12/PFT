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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Link to the user
            $table->string('icon', 100); // Saving category icon
            $table->string('title', 255); // Investment title
            $table->text('description')->nullable(); // Optional description
            $table->foreignId('investment_category')->nullable()->constrained()->onDelete('set null'); // Foreign key to investment_categories table
            $table->timestamps();
            $table->softDeletes(); // Soft delete for tracking deleted records
            
            // Ensure title is unique within the user's investments
            $table->unique(['user_id', 'title']);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('investments');
    }
};
