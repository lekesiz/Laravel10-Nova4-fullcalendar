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
        Schema::create('client_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('designation');
            $table->text('address');
            $table->text('address_complement')->nullable();
            $table->string('postal_code');
            $table->string('city');
            $table->string('department')->nullable();
            $table->string('country');
            $table->text('note')->nullable();
            $table->boolean('billing_address')->default(false);
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_addresses');
    }
};
