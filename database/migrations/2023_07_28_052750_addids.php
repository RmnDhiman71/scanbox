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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('txn_id')->nullable();
            $table->foreignId('batch_id')->nullable()->constrained('codes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('txn_id')->nullable();
            $table->foreignId('batch_id')->nullable()->constrained('codes')->onDelete('set null');
        });
    }
};
