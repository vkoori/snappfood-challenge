<?php

namespace App\Repositories\BaseRepository;

use App\Constraint\BaseRepository\BaseRepository as ConstraintBaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements ConstraintBaseRepository
{
    protected Model $model;

    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        //todo insert condition
        return $this->model->with($relations)->get($columns);
    }

    /**
     * @param int $modelId
     * @param array $columns
     * @param array $relations
     * @param array $appends
     * @return Model|null
     */
    public function findById(int $modelId, array $columns = ['*'], array $relations = [], array $appends = []): ?Model
    {
        return $this->model->select($columns)->with($relations)->find($modelId);
    }

    /**
     * @param array $payload
     * @return Model|null
     */
    public function create(array $payload): ?Model
    {
        return $this->model->query()->create($payload);
    }

    /**
     * @param int $modelId
     * @param array $payload
     * @return bool
     */
    public function update(int $modelId, array $payload): bool
    {
        return $this->findByIdOrFail($modelId)->update($payload);
    }

    /**
     * @param int $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool
    {
        return $this->findByIdOrFail($modelId)->delete();
    }

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
    ): Model
    {
        return $this->model->with($relations)->findOrFail($modelId, $columns);
    }

    /**
     * @param  array  $columns
     * @param  array  $relations
     * @return Model|null
     */
    public function first(
        array $columns = ['*'],
        array $relations = []
    ): ?Model
    {
        return $this->model->with($relations)->first($columns);
    }

    /**
     * @param  array  $columns
     * @param  array  $relations
     * @return Model
     */
    public function firstOrFail(
        array $columns = ['*'],
        array $relations = []
    ): Model
    {
        return $this->model->with($relations)->firstOrFail($columns);
    }
}
