<?php

namespace App\Models;

use App\Enums\Queues;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property $id
 * @property $queue
 * @property $identifier
 * @property $payload
 * @property $attempts
 * @property $reserved_at
 * @property $available_at
 * @property $created_at
 */
class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';
    protected $guarded = ['id'];

    protected $casts = [
        'payload' => 'array'
    ];

    public function getFirstInQueueAgenet(): Job
    {
        $job = $this->query()->where('queue', Queues::AGENT_CHECK_QUEUE->value)->firstOrFail();
        $this->query()->whereId($job->id)->delete();
        return $job;
    }
}
