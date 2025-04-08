<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alternatives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('criteria_id');
            $table->unsignedBigInteger('weight_id');
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('criteria_id')->references('id')->on('criteria')->onDelete('cascade');
            $table->foreign('weight_id')->references('id')->on('weights')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alternatives');
    }
};
