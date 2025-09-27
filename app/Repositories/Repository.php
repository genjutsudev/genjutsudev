<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryInterface
{
    public string $modelClass;

    public function __construct(?string $modelClass = null)
    {
        $this->modelClass = $modelClass ?: self::guessModelClass();
    }

    private static function guessModelClass(): string
    {
        return preg_replace('/(.+)\\\\Repositories\\\\(.+)Repository$/m', '$1\Models\\\$2', static::class);
    }

    public function getOne($id): Model
    {
        return $this->modelClass::query()->findOrFail($id);
    }

    public function findOne($id): ?Model
    {
        return $this->modelClass::query()->find($id);
    }

    public function getOneBy(array $params): Model
    {
        return $this->modelClass::query()->where($params)->firstOrFail();
    }

    public function findOneBy(array $params): ?Model
    {
        return $this->modelClass::query()->where($params)->first();
    }

    public function getMany(array $ids, bool $preserveOrder = false): Collection
    {
        $models = $this->modelClass::query()->find($ids);
        return $preserveOrder ? $models->orderByArray($ids) : $models;
    }

    public function getAll(): Collection
    {
        return $this->modelClass::all();
    }

    public function findFirstWhere(...$params): ?Model
    {
        return $this->modelClass::query()->firstWhere(...$params);
    }
}
