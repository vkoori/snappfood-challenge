<?php

namespace App\Http\Controllers;

use App\Enums\TestEnum;

class ExampleController extends Controller
{
    public function version()
    {
        return $this->response->ok(
            message: __('ok'),
            data: [
                'version' => app()->version(),
                'enum' => TestEnum::casesWithTranslate()
            ]);
    }
}
