<?php

namespace Tests\Feature;

use App\Account;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    public function testMakeTransaction()
    {
        $this->withoutExceptionHandling();
        factory(Account::class, 2)->create();


        $data = [
            "to" => 2,
            "amount" => 10,
            "details" => "test"
        ];

        $response = $this->json('POST', route('transactions.store', ['account' => 1]), $data);
        $response->assertStatus(201);
        $response->assertJson(['success' => true]);
    }

    public function testMakeTransactionOverBalance()
    {
        factory(Account::class, 2)->create();

        $data = [
            "to" => 2,
            "amount" => Account::find(1)->first()->balance + 100,
            "details" => "test"
        ];

        $response = $this->json('POST', route('transactions.store', ['account' => 1]), $data);
        $response->assertStatus(400);
        $response->assertJson(['success' => false]);
    }

    public function testGettingTransactions()
    {
        factory(Account::class, 2)->create();

        $data = [
            "from" => 1,
            "to" => 2,
            "amount" => Account::find(1)->first()->balance + 100,
            "details" => "test"
        ];

        $this->json('POST', route('transactions.store', ['account' => 1]), $data);

        $response = $this->json('GET', route('transactions.show', ['account' => 1]));

        $response->assertStatus(200);
    }
}
