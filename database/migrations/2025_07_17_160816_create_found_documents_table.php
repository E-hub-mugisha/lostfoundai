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
        Schema::create('found_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('full_name')->nullable();
            $table->string('id_number')->unique()->nullable();
            $table->enum('id_type', ['NID', 'Passport', 'License']);
            $table->date('date_found')->nullable();
            $table->string('location_found')->nullable();
            $table->string('image');
            $table->enum('status', ['unverified', 'matched', 'returned'])->default('unverified');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('found_documents');
    }
};
