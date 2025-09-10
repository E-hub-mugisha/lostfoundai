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
        Schema::create('lost_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('full_name');
            $table->string('id_number')->unique()->nullable();
            $table->enum('id_type', ['NID', 'Passport', 'License']);
            $table->date('date_lost')->nullable();
            $table->string('location_lost')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['pending', 'matched', 'recovered'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_documents');
    }
};
