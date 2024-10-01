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
            $table->enum('approval_status', ['Pending', 'Approved', 'Rejected', 'Transfer'])->default('Pending')->after('status');
            $table->string('approval_remark')->after('approval_status')->nullable();
            $table->integer('approval_by')->after('approval_remark')->nullable();
            $table->date('approval_at')->after('approval_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rtis', function (Blueprint $table) {
            $table->dropColumn('approval_status');
            $table->dropColumn('approval_remark');
            $table->dropColumn('approval_by');
            $table->dropColumn('approval_at');
        });
    }
};
