<?php

namespace App\Constraint\BaseRepository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ReadInterface
{
    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    public function findById(
        int $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model;

    /**
     * @param  int    $modelId
     * @param  array  $columns
     * @param  array  $relations
     * @return Model
     */
    public function findByIdOrFail(
        int $modelId,
        array $columns = ['*'],
        array $relations = []
    ): Model;

    /**
     * @param  array  $columns
     * @param  array  $relations
     * @return Model|null
     */
    public function first(
        array $columns = ['*'],
        array $relations = []
    ): ?Model;

    /**
     * @param  array  $columns
     * @param  array  $relations
     * @return Model
     */
    public function firstOrFail(
        array $columns = ['*'],
        array $relations = []
    ): Model;
}
