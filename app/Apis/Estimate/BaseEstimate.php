<?php 

namespace App\Apis\Estimate;

use App\Resources\V1\Event\Estimate\ReceiveEstimate;

interface BaseEstimate
{
	public function getEstimate(): ReceiveEstimate;
}