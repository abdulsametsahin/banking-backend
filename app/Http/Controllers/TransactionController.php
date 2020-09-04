<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Account;
use App\Helpers\Transaction\TransactionFacade;
use App\Http\Requests\TransactionStoreRequest;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    /**
     * @param Account $account
     * @return JsonResponse
     */
    public function show(Account $account): JsonResponse
    {
        return $this->makeResponse([
            'transactions' => TransactionFacade::getDTOs($account, true)
        ]);
    }

    /**
     * @param Account $account
     * @param TransactionStoreRequest $request
     * @return JsonResponse
     */
    public function store(Account $account, TransactionStoreRequest $request): JsonResponse
    {
        return TransactionFacade::save($request->denormalize()->toTransactionDTO($account));
    }
}
