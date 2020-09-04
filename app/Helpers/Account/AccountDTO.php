<?php

declare(strict_types=1);

namespace App\Helpers\Account;

class AccountDTO
{
    /**
     * @var int
     */
    private $accountId;
    /**
     * @var string
     */
    private $name;
    /**
     * @var float
     */
    private $balance;

    function __construct(int $accountId, string $name, float $balance)
    {

        $this->accountId = $accountId;
        $this->name = $name;
        $this->balance = $balance;
    }

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getAccountId(),
            'name' => $this->getName(),
            'balance' => $this->getBalance()
        ];
    }
}
