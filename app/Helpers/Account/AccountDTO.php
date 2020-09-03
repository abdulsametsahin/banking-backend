<?php

declare(strict_types=1);

namespace App\Helpers\Account;

class AccountDTO
{
    private $accountId;
    private $name;
    private $balance;

    function __construct(int $accountId, string $name, float $balance)
    {
        $this->accountId = $accountId;
        $this->name = $name;
        $this->balance = $balance;
    }

    /**
     * Get the value of accountId
     */
    public function getAccountId(): int
    {
        return $this->accountId;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of balance
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getAccountId(),
            'name' => $this->getName(),
            'balance' => $this->getBalance()
        ];
    }
}
