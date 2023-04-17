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

    public function scopeJunk(Builder $query, int $order_id)
    {
        return $query->Order($order_id)->update([
            'state' => State::JUNK_REQUEST->value
        ]);
    }

    public function scopeTrip(Builder $query, int $order_id)
    {
        return $query->Order($order_id)->update([
            'state' => State::RECEIVE_TRIP_QUEUE->value
        ]);
    }
}
