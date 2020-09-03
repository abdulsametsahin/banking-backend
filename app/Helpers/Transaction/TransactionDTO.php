<?php

declare(strict_types=1);

namespace App\Helpers\Transaction;

class TransactionDTO
{

    private $transactionId;
    private $from;
    private $to;
    private $amount;
    private $details;

    function __construct(int $transactionId, int $from, int $to, float $amount, string $details)
    {
        $this->transactionId = $transactionId;
        $this->from = $from;
        $this->to = $to;
        $this->amount = $amount;
        $this->details = $details;
    }

    /**
     * Get the value of transactionId
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Get the value of from
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Get the value of to
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Get the value of amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get the value of details
     */
    public function getDetails()
    {
        return $this->details;
    }

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
