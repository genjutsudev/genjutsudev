<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function getOne($id): Model;
    public function getOneBy(array $params): Model;
    public function findOne($id): ?Model;
    public function findOneBy(array $params): ?Model;
    public function getMany(array $ids, bool $preserveOrder = false): Collection;
    public function getAll(): Collection;
    public function findFirstWhere(...$params): ?Model;
}
