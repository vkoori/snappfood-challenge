<?php

namespace App\Resources\V1\Http\Delay;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Services\V1\Delay\Meta;

class ObjectView extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'vendor_id'         => $this->vendor_id,
            'order_id'          => $this->order_id,
            'agent_user_id'     => $this->agent_user_id,
            'user_id'           => $this->user_id,
            'carrier_user_id'   => $this->carrier_user_id,
            'extend_time'       => $this->extend_time,
            'state'             => $this->state,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }

    public function with(Request $request)
    {
        return Meta::object();
    }
}

