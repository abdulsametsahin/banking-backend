<?php

declare(strict_types=1);

namespace App\Helpers\Transaction;

use App\Account;
use App\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TransactionFacade
{
    /**
     * @param Transaction $transaction
     * @return TransactionDTO
     */
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


    /**
     * @param Account $account
     * @param bool $convertToArray
     * @return array
     */
    public static function getDTOs(Account $account, bool $convertToArray = false): array
    {
        return array_map(function (TransactionDTO $transactionDTO) use ($convertToArray) {
            return $convertToArray ? $transactionDTO->toArray() : $transactionDTO;
        }, TransactionFacade::get($account));
    }

    /**
     * @param TransactionDTO $transactionDTO
     * @return JsonResponse
     */
    public static function save(TransactionDTO $transactionDTO): JsonResponse
    {
        try {
            $fromAccount = Account::find($transactionDTO->getFrom());

            if ($fromAccount->balance < $transactionDTO->getAmount()) {
                return response()->json([
                    'success' => false,
                    'errors' => [__("insufficient balance")]
                ], 400);
            }

            DB::transaction(function () use ($transactionDTO, $fromAccount) {
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

            $fromAccount->cacheTransactions();

            return response()->json([
                'success' => true
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'errors' => [__('unhandled_error')]
            ], 400);
        }
    }

    /**
     * @param Account $account
     * @return TransactionDTO[]
     */
    public static function get(Account $account): iterable
    {
        if (!Cache::has($account->getCahceVariable())) {
            $account->cacheTransactions();
        }

        return Cache::get($account->getCahceVariable());
    }
}
