<?php 

namespace App\Http\Request\V1\Delay;

use App\Utils\Validations\FormRequest;

class Store extends FormRequest
{
	public function rules()
	{
		return [
			'vendor_id'		=> ['bail', 'required', 'integer', 'min:1'],
			'order_id'		=> ['bail', 'required', 'integer', 'min:1'],
			'user_id'		=> ['bail', 'required', 'integer', 'min:1'],
		];
	}
}