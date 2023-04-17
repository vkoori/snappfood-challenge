<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\DelayReport\State;
use Illuminate\Support\Carbon;
use Brokenice\LaravelMysqlPartition\Schema\Schema;
use Brokenice\LaravelMysqlPartition\Models\Partition;

/**
 * @property int $id
 * @property int $vendor_id
 * @property int $order_id
 * @property ?int $agent_user_id
 * @property int $user_id
 * @property ?int $carrier_user_id
 * @property ?int $extend_time
 * @property State $state
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class DelayReport extends Model
{
    use HasFactory;

    protected $table = 'delay_reports';

    protected $fillable = ['vendor_id', 'order_id', 'agent_user_id', 'user_id', 'carrier_user_id', 'extend_time', 'state'];

    protected $casts = [
        'state' => State::class
    ];

    public function scopeOrder(Builder $query, int $order_id)
    {
        return $query->where('order_id', $order_id);
    }

    public function scopeOpen(Builder $query)
    {
        return $query->whereIn('state', [
            State::RECEIVE_ORDER_QUEUE->value,
            State::AGENT_CHECK_QUEUE->value,
            State::CHECKING_AGENT->value,
            State::RECEIVE_TRIP_QUEUE->value
        ]);
    }

    public function scopeJunk(Builder $query)
    {
        return $query->update([
            'state' => State::JUNK_REQUEST->value
        ]);
    }

    public function scopeTrip(Builder $query)
    {
        return $query->update([
            'state' => State::RECEIVE_TRIP_QUEUE->value
        ]);
    }

    public function scopeEstimate(Builder $query, int $carrier_id, int $estimate)
    {
        return $query->update([
            'state' => State::ESTIMATED->value,
            'carrier_user_id' => $carrier_id,
            'extend_time' => $estimate
        ]);
    }

    public function scopeAgentState(Builder $query)
    {
        return $query->update([
            'state' => State::AGENT_CHECK_QUEUE->value
        ]);
    }

    public function scopeAgentUser(Builder $query, int $agent_user_id)
    {
        return $query->where('agent_user_id', $agent_user_id);
    }

    public function scopeChecking(Builder $query)
    {
        return $query->where('state', State::CHECKING_AGENT->value);
    }

    public function scopeAssignToAgent(Builder $query, int $delayId, int $agentId)
    {
        return $query->whereId($delayId)->update([
            'state' => State::CHECKING_AGENT->value,
            'agent_user_id' => $agentId
        ]);
    }

    public function scopeMostDelayedPastWeek(Builder $query)
    {
        $partitions = [];
        $partitions[] = $this->getPartitionName(date: Carbon::now());

        $pastMonth = Carbon::now()->subMonth();
        if ($this->hasPartition($pastMonth)) {
            $partitions[] = $this->getPartitionName(date: $pastMonth);
        }

        return $query
            ->partitions($partitions)
            ->groupBy('vendor_id')
            ->selectRaw('sum(extend_time) as extend_times')
            ->addSelect('vendor_id')
            ->orderBy('extend_time', 'desc')
            ->paginate();
    }

    public function getAllPartitions(): \Illuminate\Support\Collection
    {
        $partitions = Schema::getPartitionNames(
            db: app('db')->connection()->getDatabaseName(), 
            table: $this->getTable()
        );
        return collect($partitions);
    }

    public function getPartitionName(Carbon $date)
    {
        return 'p' . $date->format('Ym');
    }

    public function savePartition(Carbon $date)
    {
        if ($this->getAllPartitions()->first()->PARTITION_NAME) {
            # eloquent binding has bug :)
            app('db')->statement(
                "ALTER TABLE {$this->getTable()} 
                ADD PARTITION (
                    PARTITION {$this->getPartitionName(date: $date)} 
                    VALUES LESS THAN (".$date->format('Y') * 100 + $date->format('m').")
                );",
            );
        } else {
            Schema::partitionByRange(
                table: $this->getTable(),
                column: 'YEAR(created_at) * 100 + MONTH(created_at)',
                partitions: [
                    new Partition(
                        name: $this->getPartitionName(date: $date),
                        type: Partition::RANGE_TYPE,
                        value: $date->format('Y') * 100 + $date->format('m')
                    )
                ],
                includeFuturePartition: false
            );
        }
    }

    public function hasPartition(Carbon $date)
    {
        return $this->getAllPartitions()->contains(
            'PARTITION_NAME', $this->getPartitionName(date: $date)
        );
    }
}
