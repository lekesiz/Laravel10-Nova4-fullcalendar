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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('client_type');
            $table->string('civility')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('mobile_phone')->nullable();
            $table->string('landline_phone')->nullable();
            $table->string('accounting_code')->nullable();
            $table->integer('payment_deadline')->nullable();
            $table->integer('discount')->nullable();
            $table->string('website')->nullable();
            $table->string('siret')->nullable();
            $table->string('vat')->nullable();
            $table->text('payment_conditions')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
