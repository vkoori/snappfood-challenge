<?php

namespace App\Constraint\BaseRepository;

use Illuminate\Database\Eloquent\Model;

interface WriteInterface
{
    /**
     * @param array $payload
     * @return Model|null
     */
    public function create(array $payload): ?Model;

    /**
     * @param int $modelId
     * @param array $payload
     * @return bool
     */

    public function update(int $modelId,array $payload): bool;

    /**
     * @param int $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool;
}
