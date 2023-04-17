<?php 

namespace Tests\Feature\V1\Delay\User;

use App\Enums\DelayReport\State;
use App\Models\DelayReport;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class ReportTest extends TestCase
{
	use DatabaseTransactions, DatabaseMigrations;

	public function test_user_cannot_report_delay_before_touching_threshold()
	{
		$response = $this->post(
			uri: route(name: 'api.v1.user.delay.store'),
			data: [
				'vendor_id' => $this->faker->numberBetween(),
				'order_id' => 1,
				'user_id' => $this->faker->numberBetween(),
			],
			headers: $this->headerRequest
		);

		$response->seeStatusCode(201);

		$response->seeJsonStructure(structure: [
			"error",
			"status",
			"message",
			"data" => [
				"channel"
			]
		]);
	}

	public function test_when_has_open_request()
	{
		$delay = DelayReport::factory()->create([
			'state' => State::CHECKING_AGENT
		]);

		$response = $this->post(
			uri: route(name: 'api.v1.user.delay.store'),
			data: [
				'vendor_id' => $this->faker->numberBetween(),
				'order_id' => $delay->order_id,
				'user_id' => $this->faker->numberBetween(),
			],
			headers: $this->headerRequest
		);

		$response->seeStatusCode(400);

		$response->seeJsonStructure(structure: [
			"error",
			"status",
			"message",
			"errors"
		]);
	}

	public function test_when_trip_exists_and_state_not_delivered()
	{	
		$this->assertTrue(true);
	}

	public function test_when_trip_not_exists_or_state_delivered()
	{
		$this->assertTrue(true);
	}

	public function test_when_estimate_api_is_up()
	{
		$this->assertTrue(true);
	}

	public function test_when_estimate_api_is_down()
	{
		$this->assertTrue(true);
	}

	public function test_do_not_add_duplicate_order_to_the_queue()
	{
		$this->assertTrue(true);
	}

	public function test_agent_is_not_allowed_to_receive_the_order_under_review()
	{
		$this->assertTrue(true);
	}
}