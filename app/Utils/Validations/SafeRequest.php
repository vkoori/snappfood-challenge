<?php 

namespace App\Utils\Validations;

use Illuminate\Http\Request;

class SafeRequest
{
    function __construct(public Request $request)
    {
    }

    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    public function __get($name)
    {
        return $this->{$name};
    }
}