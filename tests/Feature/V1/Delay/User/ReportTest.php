<?php 

namespace Tests\Feature\V1\Delay\User;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Support\Carbon;

class StoreTest extends TestCase
{
	use DatabaseTransactions, DatabaseMigrations;

	public function test_user_cannot_report_delay_before_touching_threshold()
	{
		// $response = $this->post(
		// 	uri: route(name: 'api.v1.user.invoice.store'),
		// 	data: $this->saveData,
		// 	headers: $this->headerRequest
		// );

		// $response->seeStatusCode(200);

		// $response->seeJsonStructure(structure: [
		// 	"error",
		// 	"status",
		// 	"message",
		// 	"data" => [
		// 		"payment_tracking",
		// 		"expired_at",
		// 	]
		// ]);
	}

	public function test_when_trip_exists_and_state_not_delivered()
	{
		// $response = $this->post(
		// 	uri: route(name: 'api.v1.user.invoice.store'),
		// 	data: $this->saveData,
		// 	headers: $this->headerRequest
		// );

		// $response = $this->post(
		// 	uri: route(name: 'api.v1.user.invoice.store'),
		// 	data: $this->saveData,
		// 	headers: $this->headerRequest
		// );

		// $response->seeStatusCode(409);
	}

	public function test_when_trip_not_exists_or_state_delivered()
	{
		// $response = $this->post(
		// 	uri: route(name: 'api.v1.user.invoice.store'),
		// 	data: [],
		// 	headers: $this->headerRequest
		// );

		// $response->seeStatusCode(422);

		// $response->seeJsonStructure(structure: [
		// 	"error",
		// 	"status",
		// 	"message",
		// 	"errors"
		// ]);
	}

	public function test_when_estimate_api_is_up()
	{
		// $response = $this->post(
		// 	uri: route(name: 'api.v1.user.invoice.store'),
		// 	data: $this->saveData,
		// 	headers: []
		// );

		// $response->seeStatusCode(401);

		// $response->seeJsonStructure(structure: [
		// 	"error",
		// 	"status",
		// 	"message",
		// 	"errors"
		// ]);
	}

	public function test_when_estimate_api_is_down()
	{
		// $this->post(
		// 	uri: route(name: 'api.v1.user.invoice.store'),
		// 	data: $this->saveData,
		// 	headers: $this->headerRequest
		// );

		// $this->seeInDatabase(
		// 	table: (new ModelsInvoice)->getTable(),
		// 	data: [
		// 		'client_tracking' => $this->saveData['client_tracking'],
		// 		'user_id' => $this->saveData['user_id'],
		// 		'amount' => $this->saveData['amount'],
		// 		'currency' => $this->saveData['currency'],
		// 		'redirect' => $this->saveData['redirect'],
		// 		'comment' => $this->saveData['comment'],
		// 		'expired_at' => Carbon::now()->addMinutes($this->saveData['valid_until'])->format('Y-m-d H:i:s'),
		// 	]
		// );

		// $this->assertCount(
		// 	expectedCount: 1,
		// 	haystack: ModelsInvoice::all()
		// );

		// $this->saveData['client_tracking'] = 'another_client_tracking';

		// $this->post(
		// 	uri: route(name: 'api.v1.user.invoice.store'),
		// 	data: $this->saveData,
		// 	headers: $this->headerRequest
		// );

		// $this->seeInDatabase(
		// 	table: (new ModelsInvoice)->getTable(),
		// 	data: [
		// 		'client_tracking' => $this->saveData['client_tracking'],
		// 		'user_id' => $this->saveData['user_id'],
		// 		'amount' => $this->saveData['amount'],
		// 		'currency' => $this->saveData['currency'],
		// 		'redirect' => $this->saveData['redirect'],
		// 		'comment' => $this->saveData['comment'],
		// 		'expired_at' => Carbon::now()->addMinutes($this->saveData['valid_until'])->format('Y-m-d H:i:s'),
		// 	]
		// );

		// $this->assertCount(
		// 	expectedCount: 2,
		// 	haystack: ModelsInvoice::all()
		// );
	}

	public function test_do_not_add_duplicate_order_to_the_queue()
	{

	}

	public function test_agent_is_not_allowed_to_receive_the_order_under_review()
	{
		
	}
}