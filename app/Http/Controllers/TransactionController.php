<?php

namespace App\Http\Controllers;

use App\Helpers\Transaction\TransactionFacade;
use App\Http\Requests\TransactionStoreRequest;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    public function store(TransactionStoreRequest $request): JsonResponse
    {
        return TransactionFacade::save($request->denormalize()->toTransactionDTO());
    }
}
