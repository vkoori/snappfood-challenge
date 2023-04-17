<?php

namespace Tests;

use Laravel\Lumen\Testing\TestCase as BaseTestCase;
use Faker\Generator;
use Illuminate\Support\Carbon;

abstract class TestCase extends BaseTestCase
{
    protected array $headerRequest;
    protected Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->headerRequest = [
            'Accept' => 'application/json',
            'Accept-Language' => 'fa',
            'Authorization' => 'fake jwt'
        ];

        $this->faker = new Generator();
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

    public function travelPast(int $minutes)
    {
        Carbon::setTestNow(Carbon::now()->subMinutes($minutes));
    }

    public function travelFuture(int $minutes)
    {
        Carbon::setTestNow(Carbon::now()->addMinutes($minutes));
    }

    public function travelCurrent()
    {
        Carbon::setTestNow(Carbon::now());
    }
}
