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
        Schema::create('client_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('civility')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('position')->nullable();
            $table->string('email')->unique();
            $table->string('mobile_phone')->nullable();
            $table->string('landline_phone')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_contacts');
    }
};
