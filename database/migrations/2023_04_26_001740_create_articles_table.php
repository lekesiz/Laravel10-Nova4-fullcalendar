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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('designation');
            $table->string('type');
            $table->string('category');
            $table->string('unit');
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('coefficient', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->decimal('vat_rate', 5, 2);
            $table->decimal('price_including_tax', 10, 2);
            $table->decimal('margin', 10, 2);
            $table->decimal('margin_rate', 5, 2);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
