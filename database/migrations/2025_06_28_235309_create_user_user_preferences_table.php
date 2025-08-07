<?php

declare(strict_types=1);

use App\Models\UserUserPreference as UserPreference;
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
        Schema::create(UserPreference::ENTITY_TYPE, function (Blueprint $table) {
            $table->uuid('id')->comment('uuid');
            $table->id('nid');
            $table->uuid('user_id');
            $table->unsignedTinyInteger('is_show_age')->default(false);
            $table->unsignedTinyInteger('is_view_censored')->default(false);
            $table->unsignedTinyInteger('comments_in_profile')->default(true);
            $table->unsignedTinyInteger('achievements_in_profile')->default(true);
            $table->timestamps();
        });

        Schema::table(UserPreference::ENTITY_TYPE, function (Blueprint $table) {
            $table->unique('id', 'unq_user_user_preferences_on_id');
            $table->unique('user_id', 'unq_user_user_preferences_on_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(UserPreference::ENTITY_TYPE);
    }
};
