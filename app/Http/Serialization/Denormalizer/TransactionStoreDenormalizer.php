<?php

declare(strict_types=1);

namespace App\Http\Serialization\Denormalizer;

use App\Account;
use App\Helpers\Transaction\TransactionDTO;
use App\Http\Requests\TransactionStoreRequest;


class TransactionStoreDenormalizer implements RequestDenormalizer
{
    /** @var TransactionStoreRequest */
    private $request;

    /** @var array */
    private $attributes;

    /**
     * TransactionStoreDenormalizer constructor.
     * @param TransactionStoreRequest $request
     */
    public function __construct(TransactionStoreRequest $request)
    {
        $this->attributes = $request->validated();
        $this->request = $request;
    }

    /**
     * @inheritDoc
     */
    public function attributes(): array
    {
        return $this->attributes;
    }

    public function toTransactionDTO(Account $account): TransactionDTO
    {
        return new TransactionDTO(
            0,
            $account->id,
            $this->attributes['to'],
            floatval($this->attributes['amount']),
            $this->attributes['details']
        );
    }
}
