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
            $table->string('note')->after('approval_at')->nullable();
            $table->integer('note_added_by')->after('note')->nullable();
            $table->date('note_added_at')->after('note_added_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rtis', function (Blueprint $table) {
            $table->dropColumn('note');
            $table->dropColumn('note_added_by');
            $table->dropColumn('note_added_at');
        });
    }
};
