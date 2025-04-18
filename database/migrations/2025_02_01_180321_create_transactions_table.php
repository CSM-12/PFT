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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->morphs('category');
            $table->string('title', 50)->nullable();
            $table->text('description')->nullable();
            $table->decimal('amount', 15, 2)->default(0.00);
            $table->tinyInteger('direction')->default(0); // 1 = Incoming, 0 = Outgoing
            $table->enum('status', ['completed', 'failed', 'pending'])->default('completed');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
