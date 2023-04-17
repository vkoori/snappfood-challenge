<?php 

namespace App\Http\Request\V1\Delay;

use App\Utils\Validations\FormRequest;

class Assign extends FormRequest
{
	public function rules()
	{
		return [
			'user_id'		=> ['bail', 'required', 'integer', 'min:1'],
		];
	}
}