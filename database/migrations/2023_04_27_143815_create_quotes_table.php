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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('type');
            $table->unsignedBigInteger('client_id');
            $table->text('billing_address');
            $table->text('intervention_address');
            $table->string('responsible');
            $table->string('contact');
            $table->string('object');
            $table->date('creation_date');
            $table->date('due_date');
            $table->boolean('automatic_advance_payment_calculation');
            $table->float('percentage', 8, 2);
            $table->float('amount_ttc', 8, 2);
            $table->text('payment_terms');
            $table->text('notes')->nullable();
            $table->text('history')->nullable();
            $table->string('status');
            $table->float('total_ht', 8, 2);
            $table->float('total_ttc', 8, 2);
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
