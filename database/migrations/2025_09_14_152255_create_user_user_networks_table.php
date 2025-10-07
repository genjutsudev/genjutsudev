<?php

declare(strict_types=1);

use App\Models\UserUserNetwork as UserNetwork;
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
        Schema::create(UserNetwork::ENTITY_TYPE, function (Blueprint $table) {
            $table->uuid('id')->comment('uuid');
            $table->id('nid');
            $table->uuid('user_id');
            $table->string('network');
            $table->string('identity');
            $table->timestamps();
        });

        Schema::table(UserNetwork::ENTITY_TYPE, function (Blueprint $table) {
            $table->unique('id', 'unq_user_user_networks_on_id');
            $table->index('user_id', 'idx_user_user_networks_on_user_id');
            $table->unique(['network', 'identity'], 'unq_user_user_networks_on_network_and_identity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(UserNetwork::ENTITY_TYPE);
    }
};
