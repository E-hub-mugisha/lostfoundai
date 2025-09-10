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
        Schema::create('extracted_documents', function (Blueprint $table) {
            $table->id();
            $table->string('names');
            $table->date('dob')->nullable();
            $table->string('sex')->nullable();
            $table->string('place_of_issue')->nullable();
            $table->string('id_number')->unique();
            $table->string('file_path'); // path to stored image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extracted_documents');
    }
};
