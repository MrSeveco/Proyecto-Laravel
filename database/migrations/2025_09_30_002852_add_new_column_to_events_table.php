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
        // Safeguard: if the events table doesn't exist yet (fresh deploy), skip.
        if (!Schema::hasTable('events')) {
            return;
        }

        Schema::table('events', function (Blueprint $table) {
            // Only add the column/constraint if it's not already present
            if (!Schema::hasColumn('events', 'fk_venue_event')) {
                $table->foreignId('fk_venue_event')->nullable()->constrained('venues', 'id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('events')) {
            return;
        }

        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'fk_venue_event')) {
                $table->dropForeign(['fk_venue_event']);
                $table->dropColumn('fk_venue_event');
            }
        });
    }
};
