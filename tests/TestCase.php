<?php

namespace Tests;

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected array $headerRequest;

    protected function setUp(): void
    {
        parent::setUp();

        $this->headerRequest = [
            'Accept' => 'application/json',
            'Accept-Language' => 'fa',
            'Authorization' => 'fake jwt'
        ];
    }

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }
}
