<?php

namespace Database\Factories;

use App\Enums\DelayReport\State;
use App\Models\DelayReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class DelayReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DelayReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vendor_id'         => $this->faker->numberBetween(),
            'order_id'          => $this->faker->numberBetween(),
            'agent_user_id'     => $this->faker->boolean() ? $this->faker->numberBetween() : null,
            'user_id'           => $this->faker->numberBetween(),
            'carrier_user_id'   => $this->faker->boolean() ? $this->faker->numberBetween() : null,
            'extend_time'       => $this->faker->boolean() ? $this->faker->numberBetween(0,180) : null,
            'state'             => $this->faker->randomElement(State::values()),
        ];
    }
}
