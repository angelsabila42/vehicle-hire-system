<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('price_per_day')->constrained('users')->onDelete('cascade');
            $table->foreignId('manager_id')->nullable()->after('user_id')->constrained('managers', 'manager_id')->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['manager_id']);
            $table->dropColumn('manager_id');
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
        });
    }
};
