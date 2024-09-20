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
        Schema::create('rtis', function (Blueprint $table) {
            $table->id();
            $table->string('dispatch_no')->nullable();
            $table->string('unique_applicant_no')->nullable();
            $table->string('applicant_name')->nullable();
            $table->date('received_date')->nullable();
            $table->date('date')->nullable();
            $table->string('subject')->nullable();
            $table->integer('concerned_department')->nullable();
            $table->string('name_of_concerned_officer')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rtis');
    }
};
