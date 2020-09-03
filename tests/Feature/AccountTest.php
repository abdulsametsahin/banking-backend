<?php

namespace Tests\Feature;

use App\Account;
use App\Helpers\Account\AccountFacade;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function testGetAccount()
    {
        $this->withoutExceptionHandling();
        $account = factory(Account::class)->create();

        $response = $this->json('GET', route('accounts.show', ['account' => $account->id]));
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $response->assertJson(['data' => ['account' => AccountFacade::getDTO($account)->toArray()]]);
    }

    /**
     * @test
     */
    public function testAccountNotFound()
    {
        $response = $this->json('GET', route('accounts.show', ['account' => 1]));
        $response->assertStatus(404);
    }
}
