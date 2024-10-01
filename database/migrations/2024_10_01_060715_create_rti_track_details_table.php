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
        Schema::create('rti_track_details', function (Blueprint $table) {
            $table->id();
            $table->integer('rti_id')->nullable();
            $table->integer('old_department_id')->nullable();
            $table->integer('new_department_id')->nullable();
            $table->string('transfer_remark')->nullable();
            $table->integer('transfer_by')->nullable();
            $table->date('transfer_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rti_track_details');
    }
};
