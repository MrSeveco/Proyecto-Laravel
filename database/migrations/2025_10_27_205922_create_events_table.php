<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Solo crear la tabla si no existe (evita error en Railway)
        if (!Schema::hasTable('events')) {
            Schema::create('events', function (Blueprint $table) {
                $table->id();
                $table->string('event_name');
                $table->timestamp('event_date');
                $table->boolean('event_is_virtual')->default(false);
                $table->string('event_speaker_name');
                $table->foreignId('fk_venue_event')->nullable()->constrained('venues')->onDelete('set null');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
