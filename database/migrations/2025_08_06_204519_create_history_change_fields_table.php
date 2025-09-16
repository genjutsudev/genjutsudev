<?php

declare(strict_types=1);

use App\Models\HistoryChangeField;
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
        Schema::create(HistoryChangeField::ENTITY_TYPE, function (Blueprint $table) {
            $table->uuid('id');
            $table->id('nid');
            $table->uuidMorphs('entity', 'idx_history_change_fields_on_entity_type_and_entity_id');
            $table->string('field');
            $table->string('value');
            $table->timestamps();
            $table->uuid('changed_id');
        });

        Schema::table(HistoryChangeField::ENTITY_TYPE, function (Blueprint $table) {
            $table->unique('id', 'unq_history_change_fields_on_id');
            $table->index('changed_id', 'idx_history_change_fields_on_changed_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(HistoryChangeField::ENTITY_TYPE);
    }
};
