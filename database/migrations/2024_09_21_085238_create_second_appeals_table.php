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
        Schema::create('second_appeals', function (Blueprint $table) {
            $table->id();
            $table->string('dispatch_no')->nullable();
            $table->string('unique_applicant_no')->nullable();
            $table->integer('rti_id')->nullable();
            $table->string('file_no')->nullable();
            $table->string('who_came_from')->nullable();
            $table->string('subject')->nullable();
            $table->string('old_document')->nullable();
            $table->string('to_whom_it_was_entrusted')->nullable();
            $table->string('who_was_presented')->nullable();
            $table->string('who_was_sent')->nullable();
            $table->string('final_disposal')->nullable();
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
        Schema::dropIfExists('second_appeals');
    }
};
