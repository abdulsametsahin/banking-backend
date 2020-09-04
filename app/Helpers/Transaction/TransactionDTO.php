<?php

declare(strict_types=1);

namespace App\Helpers\Transaction;

class TransactionDTO
{
    /**
     * @var int
     */
    private $transactionId;
    /**
     * @var int
     */
    private $from;
    /**
     * @var int
     */
    private $to;
    /**
     * @var float
     */
    private $amount;
    /**
     * @var string
     */
    private $details;

    /**
     * TransactionDTO constructor.
     * @param int $transactionId
     * @param int $from
     * @param int $to
     * @param float $amount
     * @param string $details
     */
    function __construct(int $transactionId, int $from, int $to, float $amount, string $details)
    {
        $this->transactionId = $transactionId;
        $this->from = $from;
        $this->to = $to;
        $this->amount = $amount;
        $this->details = $details;
    }


    /**
     * @return int
     */
    public function getTransactionId(): int
    {
        return $this->transactionId;
    }

    /**
     * @return int
     */
    public function getFrom(): int
    {
        return $this->from;
    }

    /**
     * @return int
     */
    public function getTo(): int
    {
        return $this->to;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getDetails(): string
    {
        return $this->details;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getTransactionId(),
            'from' => $this->getFrom(),
            'to' => $this->getTo(),
            'amount' => $this->getAmount(),
            'details' => $this->getDetails()
        ];
    }
}
