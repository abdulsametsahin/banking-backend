<?php

namespace App;

use App\Helpers\Transaction\TransactionDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Account extends Model
{
    protected $fillable = [
        'name',
        'balance'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'from');
    }

    public function getCahceVariable()
    {
        return "transaction_of_" . $this->id;
    }

    public function cacheTransactions()
    {
        $transactionDTOs = array_map(function (array $transaction) {
            return new TransactionDTO(
                $transaction['id'],
                $transaction['from'],
                $transaction['to'],
                floatval($transaction['amount']),
                $transaction['details']
            );
        }, $this->transactions->toArray());
        Cache::put($this->getCahceVariable(), $transactionDTOs);
    }
}
