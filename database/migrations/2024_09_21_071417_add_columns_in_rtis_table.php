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
        Schema::table('rtis', function (Blueprint $table) {
            $table->enum('status', ['Pending', 'First Appeal', 'Second Appeal'])->default('Pending')->after('name_of_concerned_officer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rtis', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
