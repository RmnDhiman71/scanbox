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
        Schema::create('codes', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->comment('1 = Batch (Private), 2 = Bar (Public)');
            $table->string('bar_code')->nullable();
            $table->string('scratch_code')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('redeem_date')->nullable();
            $table->text('description')->nullable();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('validity')->comment('1= Days, 2=Date')->nullable();
            $table->string('valid_for')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codes');
    }
};