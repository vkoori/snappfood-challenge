<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\DelayReport\State;

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
}
