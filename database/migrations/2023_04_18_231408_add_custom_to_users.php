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
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('mobile')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->timestamp('last_login')->nullable();
            $table->softDeletes();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
