<?php

declare(strict_types=1);

use App\Models\CatalogItem;
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
        Schema::create(CatalogItem::ENTITY_TYPE, function (Blueprint $table) {
            $table->uuid('id')->comment('item_uuid');
            $table->id('nid')->comment('item_id');
            $table->string('type')->comment('Catalog\ItemTypeEnum');
            $table->string('slug');
            $table->json('titles'); // @todo сделать отдельную таблицу?
            $table->json('posters'); // @todo сделать отдельную таблицу?
            $table->string('kind')->comment('Catalog\ItemKind*Enum');
            $table->string('age_rating')->default(null)->comment('Catalog\ItemAgeRatingEnum');
            $table->decimal('score', 8, 2);
            $table->json('scores_stats');
            $table->string('status')->comment('Catalog\ItemStatusEnum');
            $table->json('statuses_stats');
            $table->date('aired_on');
            $table->date('released_on')->default(null);
            $table->json('description');
            $table->boolean('is_censored')->default(false);
            $table->integer('episodes')->default(null)->comment('anime');
            $table->integer('episodes_aired')->comment('anime, для фильмов - 1');
            $table->dateTime('next_episode_at')->default(null)->comment('anime');
            $table->integer('volumes')->default(null)->comment('manga/ranobe');
            $table->integer('volumes_aired')->default(null)->comment('manga/ranobe');
            $table->integer('chapters')->default(null)->comment('manga/ranobe');
            $table->integer('chapters_aired')->default(null)->comment('manga/ranobe');
            $table->timestamps();
        });

        Schema::table(CatalogItem::ENTITY_TYPE, function (Blueprint $table) {
            $table->unique('id', 'unq_catalog_items_on_id');
            $table->unique('slug', 'unq_catalog_items_on_slug');
            $table->index('score', 'idx_catalog_items_on_score');
            $table->index('aired_on', 'idx_catalog_items_on_aired_on');
            $table->index('released_on', 'idx_catalog_items_on_released_on');
            $table->index(['type', 'kind', 'status'], 'idx_catalog_items_on_type_and_kind_and_status');
            $table->index(['type', 'aired_on'], 'idx_catalog_items_on_type_and_aired_on');
            $table->index(['type', 'score'], 'idx_catalog_items_on_type_and_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(CatalogItem::ENTITY_TYPE);
    }
};
