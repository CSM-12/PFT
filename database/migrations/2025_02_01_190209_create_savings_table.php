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
        Schema::create('savings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Link to the user
            $table->string('icon', 100); // Saving category icon
            $table->string('title', 255); // Saving goal title (unique within the user's savings)
            $table->text('description')->nullable(); // Optional description
            $table->decimal('target_amount', 15, 2)->nullable(); // Target amount to save (nullable)
            $table->date('target_date')->nullable(); // Target date (nullable)
            $table->string('platform')->nullable(); // User-defined platform (nullable)
            
            $table->timestamps();
            $table->softDeletes(); // Soft delete for tracking deleted records
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('savings');
    }
};
