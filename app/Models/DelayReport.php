<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\DelayReport\State;

/**
 * @property int $order_id
 * @property ?int $agent_user_id
 * @property int $user_id
 * @property int $carrier_user_id
 * @property ?int $extend_time
 * @property State $state
 */
class DelayReport extends Model
{
    use HasFactory;

    protected $table = 'delay_reports';

    protected $fillable = ['order_id', 'agent_user_id', 'user_id', 'carrier_user_id', 'extend_time', 'state'];

    protected $casts = [
        'state' => State::class
    ];

}
