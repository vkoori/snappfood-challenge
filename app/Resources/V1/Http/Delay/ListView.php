<?php

namespace App\Resources\V1\Http\Delay;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;
use App\Services\V1\Delay\Meta;

class ListView extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($item) {
            return [
                'vendor_id'         => $item->vendor_id,
                'extend_times'      => $item->extend_times,
            ];
        });
    }

    public function with(Request $request)
    {
        return Meta::list();
    }

}

