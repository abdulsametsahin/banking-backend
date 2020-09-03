<?php

namespace App\Http\Controllers;

use App\Account;
use App\Helpers\Transaction\TransactionDTO;
use App\Helpers\Transaction\TransactionFacade;
use App\Http\Requests\TransactionStoreRequest;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    public function show(Account $account)
    {
        $transactions = array_map(function (TransactionDTO $transactionDTO) {
            return $transactionDTO->toArray();
        }, TransactionFacade::get($account));

        return $this->makeResponse(compact('transactions'));
    }

    public function store(Account $account, TransactionStoreRequest $request): JsonResponse
    {
        return TransactionFacade::save($request->denormalize()->toTransactionDTO($account));
    }
}
