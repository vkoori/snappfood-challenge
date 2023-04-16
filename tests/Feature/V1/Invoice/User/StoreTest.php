<?php 

namespace Tests\Feature\V1\Invoice\User;

use App\Http\Controllers\V1\Transaction\Gateways\Enums\Currency;
use App\Models\Invoice as ModelsInvoice;
use Illuminate\Support\Carbon;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class StoreTest extends TestCase
{
	use DatabaseTransactions, DatabaseMigrations;

	private array $saveData;

	protected function setUp(): void
	{
		parent::setUp();

		$this->saveData = [
			'client_tracking' => 'client_tracking',
			'user_id' => 1,
			'amount' => 1000,
			'currency' => Currency::IRR->value,
			'redirect' => 'https://google.com/',
			'comment' => 'comment',
			'valid_until' => 180,
		];
	}

	public function runDatabaseMigrations()
	{
		$this->artisan('migrate --path=/database/migrations/2023_03_22_080129_create_invoices_table.php');

		$this->beforeApplicationDestroyed(function () {
			$this->artisan('migrate:rollback');
		});
	}

	public function test_store_invoice()
	{
		$response = $this->post(
			uri: route(name: 'api.v1.user.invoice.store'),
			data: $this->saveData,
			headers: $this->headerRequest
		);

		$response->seeStatusCode(200);

		$response->seeJsonStructure(structure: [
			"error",
			"status",
			"message",
			"data" => [
				"payment_tracking",
				"expired_at",
			]
		]);
	}

	public function test_avoid_save_duplicate_invoice()
	{
		$response = $this->post(
			uri: route(name: 'api.v1.user.invoice.store'),
			data: $this->saveData,
			headers: $this->headerRequest
		);

		$response = $this->post(
			uri: route(name: 'api.v1.user.invoice.store'),
			data: $this->saveData,
			headers: $this->headerRequest
		);

		$response->seeStatusCode(409);
	}

	public function test_store_invoice_with_invalid_body()
	{
		$response = $this->post(
			uri: route(name: 'api.v1.user.invoice.store'),
			data: [],
			headers: $this->headerRequest
		);

		$response->seeStatusCode(422);

		$response->seeJsonStructure(structure: [
			"error",
			"status",
			"message",
			"errors"
		]);
	}

	public function test_store_invoice_with_invalid_header()
	{
		$response = $this->post(
			uri: route(name: 'api.v1.user.invoice.store'),
			data: $this->saveData,
			headers: []
		);

		$response->seeStatusCode(401);

		$response->seeJsonStructure(structure: [
			"error",
			"status",
			"message",
			"errors"
		]);
	}

	public function test_check_db_when_storing_data()
	{
		$this->post(
			uri: route(name: 'api.v1.user.invoice.store'),
			data: $this->saveData,
			headers: $this->headerRequest
		);

		$this->seeInDatabase(
			table: (new ModelsInvoice)->getTable(),
			data: [
				'client_tracking' => $this->saveData['client_tracking'],
				'user_id' => $this->saveData['user_id'],
				'amount' => $this->saveData['amount'],
				'currency' => $this->saveData['currency'],
				'redirect' => $this->saveData['redirect'],
				'comment' => $this->saveData['comment'],
				'expired_at' => Carbon::now()->addMinutes($this->saveData['valid_until'])->format('Y-m-d H:i:s'),
			]
		);

		$this->assertCount(
			expectedCount: 1,
			haystack: ModelsInvoice::all()
		);

		$this->saveData['client_tracking'] = 'another_client_tracking';

		$this->post(
			uri: route(name: 'api.v1.user.invoice.store'),
			data: $this->saveData,
			headers: $this->headerRequest
		);

		$this->seeInDatabase(
			table: (new ModelsInvoice)->getTable(),
			data: [
				'client_tracking' => $this->saveData['client_tracking'],
				'user_id' => $this->saveData['user_id'],
				'amount' => $this->saveData['amount'],
				'currency' => $this->saveData['currency'],
				'redirect' => $this->saveData['redirect'],
				'comment' => $this->saveData['comment'],
				'expired_at' => Carbon::now()->addMinutes($this->saveData['valid_until'])->format('Y-m-d H:i:s'),
			]
		);

		$this->assertCount(
			expectedCount: 2,
			haystack: ModelsInvoice::all()
		);
	}
}