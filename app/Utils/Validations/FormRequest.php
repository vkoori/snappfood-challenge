<?php 

namespace App\Utils\Validations;

use App\Utils\Validations\Exceptions\ValidationError;
use Illuminate\Http\Request;

class FormRequest
{
	/**
	 * @var \Illuminate\Contracts\Validation\Validator
	 */
	private $validator;

	function __construct(protected Request $request)
	{
		$this->manualValidator();
	}

	/**
     * @return array
     */
	public function validationData()
    {
        return $this->request->all();
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [];
    }

    /**
     * @var array
     */
    public function validated()
    {
    	return $this->validator->validated();
    }

	private function manualValidator(): void
	{
		$this->createDefaultValidator()->checkFailsValidator();
	}

    private function getValidationFactory(): \Illuminate\Contracts\Validation\Factory
    {
        return app('validator');
    }

	private function createDefaultValidator(): self
	{
		$this->validator = $this->getValidationFactory()->make(
			data: $this->validationData(),
			rules: $this->rules(),
			messages: $this->messages(),
			attributes: $this->attributes()
		);

		return $this;
	}

	private function checkFailsValidator(): void
    {
        if ($this->validator->fails()) {
        	$this->failedValidation();
        }
    }

	private function formatValidationErrors(): array
    {
        return $this->validator->errors()->getMessages();
    }

	private function failedValidation(): \Throwable
    {
    	$messages = $this->formatValidationErrors($this->validator);
    	$messages = array_map(function($item) { return $item[0]; }, $messages);

    	throw new ValidationError(
    		data: $messages
    	);
    }

}