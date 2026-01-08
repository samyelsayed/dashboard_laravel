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
        // بنضيف العمود ونخليه nullable عشان الداتا القديمة متضربش
        $table->string('device_name')->nullable()->after('password');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
        // في حالة التراجع بنمسح العمود
        $table->dropColumn('device_name');
       });
    }
};
