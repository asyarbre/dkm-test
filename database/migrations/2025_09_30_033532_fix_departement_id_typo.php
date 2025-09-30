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
        Schema::table('requests', function (Blueprint $table) {
            // Check if the misspelled column exists and drop it
            if (Schema::hasColumn('requests', 'departement_id')) {
                $table->dropColumn('departement_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table) {
            // This migration is irreversible as we're fixing a typo
            // The down migration would recreate the misspelled column
        });
    }
};
