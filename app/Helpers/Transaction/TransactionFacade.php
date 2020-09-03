<?php

declare(strict_types=1);

namespace App\Helpers\Transaction;

use App\Account;
use App\Transaction;
use Exception;
use Illuminate\Http\JsonResponse;

class TransactionFacade
{
    public static function getDTO(Transaction $transaction): TransactionDTO
    {
        return new TransactionDTO(
            $transaction->id,
            $transaction->from,
            $transaction->to,
            floatval($transaction->amount),
            $transaction->details
        );
    }

    public static function save(TransactionDTO $transactionDTO): JsonResponse
    {
        try {
            $fromAccount = Account::find($transactionDTO->getFrom());

            if ($fromAccount->balance < $transactionDTO->getAmount()) {
                return response()->json(['success' => false, 'errors' => [__("insufficient balance")]], 400);
            }

            \DB::transaction(function () use ($transactionDTO, $fromAccount) {
                $fromAccount->balance -= $transactionDTO->getAmount();
                $fromAccount->save();

                $toAccount = Account::find($transactionDTO->getTo());
                $toAccount->balance -= $transactionDTO->getAmount();
                $toAccount->save();

                $transaction = new Transaction;
                $transaction->from = $fromAccount->id;
                $transaction->to = $toAccount->id;
                $transaction->amount = $transactionDTO->getAmount();
                $transaction->details = $transactionDTO->getDetails();
                $transaction->save();
            });
            return response()->json(['success' => true], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'errors' => [__('unknown_error')]], 400);
        }
    }
}
