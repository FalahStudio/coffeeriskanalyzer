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
        Schema::create('schema', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('user_credential')->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('end_date');
            $table->boolean('status');
            $table->timestamps();
        });

        Schema::create('risk', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('schema_id')->references('id')->on('schema')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('risk');
            $table->text('data_risk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schema');
        Schema::dropIfExists('risk');
    }
};
