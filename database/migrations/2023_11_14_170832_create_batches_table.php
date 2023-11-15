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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->text('description')->nullable();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('validity')->comment('1= Days, 2=Date')->nullable();
            $table->string('valid_for')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};