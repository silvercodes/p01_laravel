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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 256);
            $table->string('description')->nullable();
            $table->double('price');
            $table->unsignedBigInteger('qty')->default(0);

            $table->unsignedBigInteger('sub_category_id');

            $table->timestamps();

            $table->foreign('sub_category_id')
                ->references('id')
                ->on('sub_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
